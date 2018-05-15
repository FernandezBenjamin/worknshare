
#include "lib/functions.h"

// gcc `xml2-config --cflags --libs` lib/*.h fusion.c -o fusion.exe

int main(int argc, char *argv[]){

    char *targetDir = NULL;
    char *pathFusion = NULL;
    char *pathXml = NULL;
    char *nameFile = NULL;
    FILE * file = NULL;
    int error = 0;

    // dirent.h
    DIR *rep = NULL;
    struct dirent *fichierLu = NULL;

    // time.h
    time_t secondes;
    struct tm now;
    char date[7] = "";
    char *day = NULL;

    CLEAR;

    // Allocation
    nameFile = malloc(sizeof(char)*255);

    // Select directories where we work
    // Check if we have path_fusion and path_xml
      // path_fusion (argv[1]) = path where you want to stock the file fusion
      // path_xml    (argv[2]) = path where we have your xml file for fusion

    // Dir fusion
    if(!(argc < 3 || argc > 3)){
      if(opendir(argv[1])){
        pathFusion = malloc(sizeof(char)*500);
        strcat(pathFusion,argv[1]);
      }
      if(opendir(argv[2])){
        pathXml = malloc(sizeof(char)*500);
        strcat(pathXml,argv[2]);
      }
    }

    if(pathFusion == NULL){
      pathFusion = selectDir(1);
    }

    if(pathXml == NULL){
      pathXml = selectDir(2);
    }


    printf("## SUCCES ## dir_fusion -> %s\n",pathFusion );
    printf("## SUCCES ## path_dir_xml -> %s\n",pathXml );


      // // Set the time
      // if (time(&secondes)== -1){
      //   printf("## ERROR ## The program can't have the time\n" );
      //   exit(EXIT_FAILURE);
      // }
      // now = *localtime(&secondes);

    // Check if the date enter is valid
    do{
      printf("When you want merge ?\n");
      myFgets(date,7);
      if(!checkDate(date)){
        printf("## ERROR ## You date isn't valide, please try again\n");
        error = 1;
      }
    }while(error);

    printf("## SUCCES ## Your date is %s\n", date);

    //Set the target
    targetDir = split(date,2,5);
    strcat(targetDir,"/");
    strcat(pathFusion,targetDir);


    // Regarder si le dossier MMAA/ existe
    if (!opendir(pathFusion)){
      // if don't, create it
      mkdir(pathFusion,0755);
    }
    rep = opendir(pathFusion);




    //Set name file
    day = split(date,0,1);
    strcat(nameFile,pathFusion);
    strcat(day,".xml");
    strcat(nameFile,day);

    // Check if JJ.xml exist
    file = fopen(nameFile,"r+b");
    if(file == NULL){
      printf("## ERROR ## %s doesn't exist yet\n",day );
      if(!createFileFusionXML(nameFile)){
        printf("## ERROR ## The file fusion can't be created\n");
      }
      printf("## SUCCES ## %s was created\n",day );
    }else{
      fclose(file);
    }

    // Do fusion
    listFile(pathXml, date, pathFusion);
    printf("## SUCCES ## The fusion is complete\n");


    if (closedir(rep) == -1)
        exit(-1);

    free(nameFile);
    if(!argv[1]){
      free(pathFusion);
    }
    if(!argv[2]){
      free(pathXml);
    }
    free(day);

    return 0;
}
