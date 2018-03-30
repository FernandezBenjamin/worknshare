#include "quirc.h"
#include <stdio.h>
#include <cv.h>
#include <highgui.h>


int main(int argc, char *argv[]){


  IplImage *newImage;
  IplImage *destination;
  char key;
  uint8_t *image;
  int width, height, size, cpt, num_codes;
  int i;
  struct quirc *qr;
  struct quirc_code code;
  struct quirc_data data;
  quirc_decode_error_t err;

  CvCapture* capture = cvCreateCameraCapture( CV_CAP_ANY );
  if(capture){
  	if(!cvQueryFrame(capture)){
    		printf("Capture de l'image ratée\n\7");
    		exit(0);
  	}
  }
  else{
  	printf("Could not open video device\n");
  	exit(0);
  }

   cvNamedWindow("Scanner", CV_WINDOW_AUTOSIZE);

   while(key != 'q'){
     newImage = cvQueryFrame(capture);
     cvShowImage("Scanner", newImage);

     key = cvWaitKey(10);

     destination = cvCreateImage(cvSize( newImage->width, newImage->height ), IPL_DEPTH_8U, 1 );
     cvCvtColor(newImage, destination, CV_RGB2GRAY);

      qr = quirc_new();
      if(!qr){
        perror("Echec de l'allocation");
        abort();
      }
      if(quirc_resize(qr, 640, 480) < 0){
        perror("Echec de la redimension");
        abort();
      }

     width = destination->width;
     height = destination->height;
     size = width * height;

     image = quirc_begin(qr, &width, &height);
     for(cpt = 0; cpt < size; cpt++){
       image[cpt] = destination->imageData[cpt];
     }

     quirc_end(qr);


     num_codes = quirc_count(qr);
     for (i = 0; i < num_codes; i++) {
        quirc_extract(qr, i, &code);

        err = quirc_decode(&code, &data);
        if (err)
    	    printf("DECODE FAILED: %s\n", quirc_strerror(err));
        else{
    	   printf("Data: %s\n", data.payload);
         quirc_destroy(qr);
         cvReleaseImage(&newImage );
         cvReleaseCapture(&capture);
         return 0;
       }
     }
    }
}
