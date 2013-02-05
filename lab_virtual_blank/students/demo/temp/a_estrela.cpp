#include "a_estrela.h"

int exp2(int num){
    return num * num;
}

void menu(){
    printf("#####MEU PRIMEIRO PROGRAMA EM C!!! #####\n");
    printf("Universidade Federal do Ceará\n");
    printf("Teste!!!\n");
    printf("Fundamentos de Programação\n");
    printf("Aluno: Jose Antonio da Silva\n");
    printf("########################################\n");

}

int main(){
    menu();
    printf("O numero 2 ao quadrado eh %d \n", exp2(2));
    printf("O numero 2 ao quadrado eh %d \n", exp2(2));
}