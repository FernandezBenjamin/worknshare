
#include "lib/functions.h"

// gcc `xml2-config --cflags --libs` lib/*.h inout.c -o inout.exe


#if defined(LIBXML_TREE_ENABLED) && defined(LIBXML_OUTPUT_ENABLED)

// =============== MAIN ===============
int main(int argc, char const *argv[]) {

  char *nameFile = NULL;
  char *nameFileFusion = NULL;
  FILE *file;
  xmlDoc *doc = NULL;
  xmlDoc *doc_site = NULL;
  xmlNode *root_node = NULL;
  xmlNode *root_site = NULL;
  xmlNode *target = NULL;


  LIBXML_TEST_VERSION;

  nameOfFile(&nameFile);
  if(nameFile == NULL){
    printf("## ERROR ## Can't create a file\n");
    exit(EXIT_FAILURE);
  }

  file = fopen(nameFile,"r+b");
  if(file == NULL){
    printf("## ERROR ## File doesn't exist\n");
    doc = createFileXML(nameFile);
    printf("## SUCCES ## File was created\n");
  }else{
    doc = xmlReadFile(nameFile,NULL,0);
    printf("## SUCCES ## File exist\n");
  }

  if(!doc){
    printf("## ERROR ## We can't read the file \n");
    exit(EXIT_FAILURE);
  }

  root_node = xmlDocGetRootElement(doc);



  if(!root_node){
    printf("## ERROR ## We can't find <root> \n");
    exit(EXIT_FAILURE);
  }

  start(nameFile,root_node);



  //Free all pointers
  xmlFreeDoc(doc);
  xmlCleanupParser();
  xmlMemoryDump();

  return 0;
}
#else
int main(void) {
    printf("tree support not compiled in\n");
    exit(EXIT_FAILURE);
}
#endif
