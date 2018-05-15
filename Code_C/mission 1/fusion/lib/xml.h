#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <libxml/parser.h>
#include <libxml/tree.h>


// =============== PROTOTYPES ===============
xmlDoc * createFileXML ( char *FileName);           // Create the basic xml file with the basics nodes we need
void addInOut( int choice, xmlNode *root_node, char *id, char *dateNow);   // Add an output in the xml file
xmlNode * findChild( xmlNode *a_node, char *target); // Search a node and return it if find it
char * findName(char *pathFile);

xmlDoc * createFileFusionXML ( char *FileName);
void addSite (char * nameFileSite, char * nameFileFusion);

void * display( xmlNode *a_node);

// =============== FUNCTION ===============



xmlDoc * createFileXML (char *FileName){
  // Create all pointer we need (document and nodes)
  xmlDocPtr doc = NULL;
  xmlNodePtr root = NULL;
  xmlNodePtr node = NULL;

  //Set the document pointer and the main node
  doc = xmlNewDoc(BAD_CAST "1.0");
  root = xmlNewNode(NULL, BAD_CAST "root");
  xmlDocSetRootElement(doc, root);

  //Set the node "inputs"
  node = xmlNewNode(NULL, BAD_CAST "inputs");
  xmlAddChild(root, node);

  //Set the node "outputs"
  node = xmlNewNode(NULL, BAD_CAST "outputs");
  xmlAddChild(root, node);

  //Save in the document
  xmlSaveFormatFileEnc(FileName,doc, "UTF-8", 1);

  return doc;
}


xmlNode * findChild( xmlNode *a_node, char *target){

  xmlNode *cur_node = NULL;
  for(cur_node = a_node->children; cur_node != NULL && strcmp(cur_node->name,target); cur_node = cur_node->next);
  return cur_node;
}


// 0 -> input
// 1 -> output
void addInOut( int choice, xmlNode *root_node, char *id, char *dateNow){
  char *charChoice[2] = {
                          "input",
                          "output"
                        };
  char tmp[10]= "";
  xmlNode * target = NULL;
  xmlNode * newNode = NULL;

  if( choice >= 0 && choice <= 1){

    strcat(strcat(tmp,charChoice[choice]),"s");

    target = findChild(root_node,tmp);

    if(target){
      newNode = xmlNewNode(NULL, BAD_CAST charChoice[choice]);
      xmlNewProp(newNode, BAD_CAST "id", BAD_CAST id);
      xmlNewProp(newNode, BAD_CAST "time", BAD_CAST dateNow);
      xmlAddChild(target,newNode);
    }else{
      printf("## ERROR ## We can't add the line\n");
    }
  }else{
    printf("## ERROR ## Wrong option >> %d\n",choice);
    exit(EXIT_FAILURE);
  }
}

char * findName(char *pathFile){
  char * name = NULL;

  name = malloc(sizeof(char)*50);
  int res = 0;

  // All check
  res = strlen(strrchr(pathFile,47))-strlen(strrchr(pathFile,95));

  if(!strrchr(pathFile,47) || !strrchr(pathFile,95) ){
    return NULL;
  }
  if (res <= 5) {
    return NULL;
  }

  strncpy(name, strrchr(pathFile,47), (strlen(strrchr(pathFile,47))-strlen(strrchr(pathFile,95))));
  name[(strlen(strrchr(pathFile,47))-strlen(strrchr(pathFile,95)))] = '\0';

  return name;
}


// =============== FUSION ===============

xmlDoc * createFileFusionXML (char *FileName){

  // Create all pointer we need (document and nodes)
  xmlDocPtr doc = NULL;
  xmlNodePtr root = NULL;
  xmlNodePtr node = NULL;

  //Set the document pointer and the main node
  doc = xmlNewDoc(BAD_CAST "1.0");
  root = xmlNewNode(NULL, BAD_CAST "root");
  xmlDocSetRootElement(doc, root);

  //Set the node "inputs"
  node = xmlNewNode(NULL, BAD_CAST "sites");
  xmlAddChild(root, node);

  //Save in the document
  xmlSaveFormatFileEnc(FileName,doc, "UTF-8", 1);

  return doc;
}

void addSite (char * nameFileSite, char * nameFileFusion){

  if( !nameFileSite || !nameFileFusion )
    return;



  char *nameSite = NULL;

  xmlDoc * doc_site = NULL;
  xmlDoc * doc_fusion = NULL;

  xmlNode * root_site = NULL;
  xmlNode * root_fusion = NULL;

  xmlNode * newSite = NULL;
  xmlNode * newNode = NULL;
  xmlNode * target = NULL;
  xmlNode * cursor = NULL;

  xmlChar * id = NULL;
  xmlChar * timeInOut = NULL;



  doc_site = xmlReadFile(nameFileSite,NULL,0);
  doc_fusion = xmlReadFile(nameFileFusion,NULL,0);



  root_site = xmlDocGetRootElement(doc_site);
  root_fusion = xmlDocGetRootElement(doc_fusion);



  // cree la balise site name="..."
  target = findChild(root_fusion,"sites");
  nameSite = findName(nameFileSite);



  if(!nameSite){
    printf("## ERROR ## Name of site is empty\n");
    exit(EXIT_FAILURE);
  }

  newSite = xmlNewNode(NULL, BAD_CAST "site");
  xmlNewProp(newSite, BAD_CAST "name", BAD_CAST nameSite);
  xmlAddChild(target,newSite);

  // cree inputs dans fusion
  newNode = xmlNewNode(NULL, BAD_CAST "inputs");
  xmlAddChild(newSite,newNode);

  // cree outputs
  newNode = xmlNewNode(NULL, BAD_CAST "outputs");
  xmlAddChild(newSite,newNode);

  xmlSaveFormatFileEnc(nameFileFusion,root_fusion->doc, "UTF-8", 1);

  // se mettre sur le input
  target = findChild(root_site,"inputs");
  target = target->children->next;

  while(target){
    // faire un addIn pour fusion
    id = xmlGetProp(target,"id");
    timeInOut = xmlGetProp(target,"time");
    addInOut(0,newSite,id,timeInOut);
    target = target->next->next;
  }

  // se mettre sur le output
  target = findChild(root_site,"outputs");
  target = target->children->next;

  // Pour chaque ouput
    // Faire un addOut pour fusion
  while(target){
    // faire un addIn pour fusion
    id = xmlGetProp(target,"id");
    timeInOut = xmlGetProp(target,"time");
    addInOut(1,newSite,id,timeInOut);
    target = target->next->next;
  }
  free(nameSite);
  xmlSaveFormatFileEnc(nameFileFusion,root_fusion->doc, "UTF-8", 1);
}



void * display( xmlNode *a_node){

  xmlNode *cur_node = NULL;


  for (cur_node = a_node; cur_node; cur_node = cur_node->next) {
      if (cur_node->type == XML_ELEMENT_NODE) {
          printf("node type: Element, name: %s\n", cur_node->name);
      }
      display(cur_node->children);
  }
}
