#include "stdio.h"

void bubbleSort(int numbers[], int array_size)
{
  int i, j, temp;
 
  for (i = (array_size - 1); i > 0; i--)
  {
    for (j = 1; j <= i; j++)
    {
      if (numbers[j-1] > numbers[j])
      {
        temp = numbers[j-1];
        numbers[j-1] = numbers[j];
        numbers[j] = temp;
      }
    }
  }
}

void menu(){
    printf("#####BUBBLE SORT EM C!!! #####\n");
    printf("Universidade Federal do Ceará\n");
    printf("Teste!!!\n");
    printf("Fundamentos de Programação\n");
    printf("Aluno: Jose Antonio da Silva\n");
    printf("########################################\n");

}


int main(){
    menu();
    int vetor[3] = { 9,8,7};
    int i = 0;
    printf("Vetor nao ordenado\n");
    for(i = 0; i < 3; i++){
        printf("%d,",vetor[i]);
    }
    printf("\n");
    
    bubbleSort(vetor,3);

    printf("Vetor ordenado\n");
    for(i = 0; i < 3; i++){
        printf("%d,",vetor[i]);
    }
}