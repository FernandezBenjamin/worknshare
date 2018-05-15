#include <string.h>
#include <time.h>
#include <dirent.h>
#include "xml.h"


#define CLEAR system("clear")

// ============================================= PROTOTYPES =============================================
  //Annexes
int menu ( int size, char **option, char * question, char * msgError);  // Display a menu and return the choice of user
void myFgets( char *str, int nb);
int verifNum( char *str);
int checkDate ( char * date);
char * split(char *str, int start, int end);



  // Main
void start( char *nameFile, xmlNode *root_node); //

  // Creation of the file
void whichOpenSpace ( char **file);  // Return the begining of the string character
void nameOfFile ( char **nameFile);  // Return the complete name of file

  // Fusion of xml file
void createFileFusion ( char **file); // Create if we need the xml file

  // dirent.h
char *selectDir (int whichDir);
void exploDir (char ** nameDir);
char * findFile(DIR * directory, char *target);
int findDir(DIR * directory, char *target);
void createDir(char *nameDir);
void displayDir (DIR * directory);
void listFile(char *dirXml, char *target, char *dirFusion);

// ============================================= FUNCTIONS =============================================
  // #################### Annexes ####################

int menu ( int size, char **option, char * question, char * msgError){

  int i;
	int number = -1;
	char choice[255];
	int check = 0;

	if (*option == NULL)
		return 0;
	do{

		printf("==============================  MENU  ==============================\n");
		for( i=0; i<size; i++){
			printf("  %d - %s\n",i,option[i]);
		}
		printf("====================================================================\n");

		printf("\n%s\n>> ", question);
		myFgets(choice,255);

    CLEAR;
		if(verifNum(choice)){
			number = atoi(choice);
		}

		if(number < 0 || number > size-1 )
			printf("%s\n",msgError);

	} while (number < 0 || number > size-1 );

	return number;
}

void myFgets(char *str,int nb){
	fflush(stdin);
    fgets(str,nb,stdin);
    if(strlen(str)<nb-1)
        str[strlen(str)-1]='\0';
}

int verifNum(char *str){
	int i = 0;
	int verif =0;

	if(str == NULL)
		return verif;
	verif = 1;
	while(i < strlen(str)){
		if(str[i]<'0' || str[i]>'9'){
			verif = 0;
			return verif;

		}
		i++;
	}
	return	verif;
}


int checkDate ( char * date){

  int i = 0;
  char* month = NULL;
  char* day = NULL;
  char* year = NULL;

  // Check if the date content only numerical value
  for( i = 0; i<6; i++){
    if(!isdigit(date[i]))
      return 0;
  }

  day = split(date,0,1);
  month = split(date,2,3);
  year = split(date,4,5);

  // Check if day is between 1 and 31
  if(atoi(day)< 1 ||atoi(day)> 31)
    return 0;

  // Check if month is between 1 and 12
  if(atoi(month)< 1 ||atoi(month)> 12)
    return 0;

  // Check if year is between 2017 and now
  if(atoi(year)< 17 ||atoi(year)> 18)
    return 0;

  free(month);
  free(day);
  free(year);

  return 1;
}

char * split(char *str, int start, int end){

  int i = 0;
  char * str_return = NULL;

  //Calculate the length of the string split
  int length = end-start+1;

  // Allocate the string ( +1 for \0)
  str_return = malloc(sizeof(char*)*length+1);

  // Do the split
  for(i = 0;i<length;i++){
    str_return[i] = str[i+start];
  }

  // Close the string
  str_return[length]='\0';

  return str_return;
}




// #################### Create of the file ####################
void whichOpenSpace (char** file){
  int choice = 0;
  char dateNow[6];
  char *option[7] = {
                      "Quit the program",
                      "Bastille",
                      "Republique",
                      "Odeon",
                      "Italie",
                      "Ternes",
                      "Beaubourg"
                    };

  choice = menu( 7,
                 option,
                 "  Please select the right open space",
                 "## ERROR ## Your enter a wrong value");

  if(choice != 0){
    *file = malloc(sizeof(char)*20);
    strcpy(*file,option[choice]);
    strcat(*file,"_");
  }else{
    *file = NULL;
  }
}

void nameOfFile (char **nameFile){
  time_t secondes;
  struct tm instant;
  char dateNow[6];

  whichOpenSpace(&(*nameFile));

  if (time(&secondes)== -1){
    printf("The program can't have the time\n" );
    exit(EXIT_FAILURE);
  }
  instant = *localtime(&secondes);

  if(*nameFile !=  NULL){
    sprintf(dateNow,"%.2d%.2d%.2d", instant.tm_mday+1, instant.tm_mon+1,instant.tm_year-100);
    strcat(*nameFile,dateNow);
    strcat(*nameFile,".xml");
  }
}

// #################### Start ####################

void start( char *nameFile, xmlNode *root_node){
  time_t secondes;
  struct tm instant;
  char dateNow[10];
  int choice = 0;
  char *option[3] = {
                      "Quit the program",
                      "Add an input",
                      "Add an output"
                    };
  do {
    choice = menu(3,option,"  What you want to do ?","## ERROR ## You enter a wrong value");
    if (time(&secondes)== -1){
      printf("The program can't have the time\n" );
      exit(EXIT_FAILURE);
    }
    instant = *localtime(&secondes);
    sprintf(dateNow,"%.2d:%.2d:%.2d", instant.tm_hour, instant.tm_min,instant.tm_sec);

    switch (choice) {
      case 1://Add input
              addInOut(0,root_node,"1",dateNow);
              printf("## SUCCES ## input add\n");
              break;
      case 2://Add ouput
              addInOut(1,root_node,"5",dateNow);
              printf("## SUCCES ## output add\n");
              break;
      default:
              break;
    }
    xmlSaveFormatFileEnc(nameFile,root_node->doc, "UTF-8", 1);
  } while(choice);

  printf(" GOOD BYE !!!\n");
}

  // #################### Fusion of xml file ####################

void createFileFusion ( char **file){

}

// #################### dirent.h ####################

char *selectDir (int whichDir){
  char *option[3] = {
                      "Quit the program",
                      "Enter the path",
                      "Navigate"
                   };
  int choice  = 0;
  int again = 1;
  char * path;
  path = malloc(sizeof(char)*255);

  if(whichDir == 1){
    printf("## INFO ## Choose Path Fusion\n");
  }else if(whichDir == 2){
    printf("## INFO ## Choose Path XML\n");
  }

  do {
    path[0] = '\0';
    choice = menu(3,
                  option,
                  " What you want to do?",
                  " ## ERROR ## Your enter a wrong value");
    switch (choice) {
      case 0:// Quit the program
        path = NULL;
        exit(EXIT_SUCCESS);
        break;
      case 1:// Enter the path
        printf("  Which directory you want ?\n");
        myFgets(path,255);
        CLEAR;
        break;
      case 2:// Navigate
        strcat(path,"/");
        exploDir(&path);
        if(opendir(path)){
          again = 0;
        }
        break;
      default:
        again = 0;
        break;
    }
    if(!opendir(path)){
      printf("## ERROR ## The path isn't correct, please try again\n");

    }else{
      again = 0;
    }
  } while(again);

  return path;
}

void exploDir (char ** nameDir){
  DIR * dir = NULL;
  char choice[255]="";
  do {
    dir = opendir(*nameDir);
    if (!dir){
      break;
    }
    displayDir(dir);
    printf(" \n\nPlease select a directory from the previous list ? (Enter !close to close the navigation)\n");
    myFgets(choice,255);
    CLEAR;
    if(strcmp(choice,"!close")){
      strcat(*nameDir,choice);
      strcat(*nameDir,"/");
    }
  } while(strcmp(choice,"!close"));
}

void displayDir (DIR * directory){
  struct dirent * fileRead = NULL;
  while ((fileRead = readdir(directory)) != NULL){
      if(!strpbrk(fileRead->d_name,".")){
        printf("  %s\n",fileRead->d_name);
      }
  }
}

char * findFile(DIR * directory, char *target){
  struct dirent * fileRead = NULL;


  while ((fileRead = readdir(directory)) != NULL){
    if(strstr(fileRead->d_name,target)){
      return fileRead->d_name;
    }
  }
  return NULL;
}

void listFile(char *dirXml, char *target, char *dirFusion){
  DIR * dir = NULL;
  struct dirent * fileRead = NULL;
  char *day = NULL;
  char * memory = NULL;

  memory = malloc(sizeof(char)*500);
  strcat(memory,dirXml);

  dir = opendir(dirXml);
  if(!dir){
    return;
  }

  day = split(target,0,1);
  strcat(dirFusion,day);
  strcat(dirFusion,".xml");

  while ((fileRead = readdir(dir)) != NULL){
    if(strstr(fileRead->d_name,target)){
      printf("## INFO ## add %s\n",fileRead->d_name);
      addSite(strcat(dirXml,fileRead->d_name),dirFusion);
      strcpy(dirXml,memory);
    }
  }

  free(day);
  free(memory);
}
