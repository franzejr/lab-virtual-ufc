#include <stdlib.h>
#include <string.h>
#include <stdio.h>


struct Quad {

      char  ei[10];
      char  si;
      char  ef[10];
      char  sf;
      struct Quad  *prox;
};

struct MT{

      char   ea[10];           // estado atual
      int    pos;              // posicao da cabeca de leitura

      int    memoria;
      char  *fita;             // fita
      int    pb;               // posicao do primeiro branco nao lido na fita

      int    tempo_max;        // tempo maximo de uma computacao 

      struct Quad  *tt;        // tabela de transicoes

};


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Rotinas para manipulacao de quadruplas
//


imprime_quadrupla (struct Quad *q)
{
     printf ("  (%s,%c,%s,%c)\n", q->ei, q->si, q->ef, q->sf);
}

struct Quad  *nova_quadrupla (char *ei, char si, char *ef, char sf) 
{
     struct Quad  *q;

     q = malloc (sizeof(struct Quad));
     strcpy(q->ei, ei);
     q->si = si;
     strcpy(q->ef, ef);
     q->sf = sf;

     q->prox = NULL;

     return(q);
}

struct Quad  *procura_quadrupla (struct Quad *lq, char *ei, char si)
{
     struct Quad  *q;

     q = lq;
     while (q != NULL) {

           if ( (strcmp(ei, q->ei) == 0)  &&  (si == q->si) )  break;

           q = q->prox;
     }

     return (q);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Rotinas para manipulacao de maquinas de Turing
//

int  imprime_definicao_MT (struct MT *M)
{
     struct Quad *q;

     printf("\nestado inicial: %s\n", M->ea);
     printf("memoria = %d  tempo_max = %d\n", M->memoria, M->tempo_max);
     printf("quadruplas: \n");
     q = M->tt;
     while (q != NULL) {
         imprime_quadrupla (q);
         q = q->prox;
     }
}

int  imprime_configuracao_MT (struct MT *M)
{
     int  i;

     printf ("(%s: ", M->ea);

     for (i=0;i<=M->pb;i++){

         if ( M->pos == i) 
            printf ("_%c", M->fita[i]);
         else
            printf (" %c", M->fita[i]);
     }

     printf (")\n");
}

struct MT  *inicializar_MT (struct MT *M, char *entrada)
{
     int  i;

     M->fita = malloc(sizeof (char) * M->memoria);

     M->fita[0] = '@';
     M->fita[1] = '#';
     for (i=0;i<strlen(entrada);i++) {
         M->fita[i+2] = entrada[i];
     }
     for (i=strlen(entrada)+2;i<M->memoria;i++) {
         M->fita[i] = '#';
     }

     M->pos = 1;
     M->pb  = strlen(entrada) + 2;
}

int  carregar_MT (struct MT *M, char *arquivo)
{
     FILE *f;
     char  ei[10], si, ef[10], sf;
     int   memoria, tempo;

     struct Quad *q;


     f = fopen(arquivo, "r");
     if (f == NULL) {
        printf ("erro na abertura do arquivo\n");
        return(-1);
     }

     fscanf (f, "%s %d %d", M->ea, &memoria, &tempo);
     M->memoria = memoria;
     M->tempo_max = tempo;

     while (! feof(f) ){

           fscanf (f, "%s %c %s %c", ei, &si, ef, &sf);

           if ( procura_quadrupla (M->tt, ei, si) == NULL ) {
  
              q = nova_quadrupla (ei, si, ef, sf);
  
              q->prox = M->tt;
              M->tt = q;
           }
           // else {    
           //     printf ("maquina nao deterministica\n");
           //     return(-1);
           // }
     }

     fclose (f);
     return (1);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Rotinas para simulacao de maquinas de Turing
//

int  simular_passo (struct MT *M)
{
     struct Quad *q;

     q = procura_quadrupla (M->tt, M->ea, M->fita[M->pos]);
  
     if (q == NULL)  return(-1);     // nenhuma quadrupla se aplica 'a configuracao atual

     strcpy(M->ea, q->ef);           // atualizar o estado da maquina

     if (q->sf == '<') {             // mover cabeca para esquerda 

        if (M->pos == 0) {
           printf("erro: violacao do limite esquerdo da fita\n");
           return (-1);
        }

        M->pos --;                   
     }

     else if (q->sf == '>') {        // mover cabeca para direita      

        if (M->pos == M->memoria - 1) {
           printf("erro: violacao do limite direito da fita\n");
           return (-1);
        }

        M->pos ++;                   
        if (M->pos >= M->pb)  M->pb = M->pos + 1;
     }

     else {                          // escrever simbolo na fita

        if (M->pos == 0) {     
           printf("erro: tentativa de escrever na primeira posicao da fita\n");
           return (-1);
        }

        M->fita[M->pos] = q->sf;     
     }

     return (1);
}

int  simular_MT (struct MT *M)
{
     int  cont = 0;
     int  status;

     do {

         status = simular_passo (M);

         if (status == 1) {
            cont ++;
            imprime_configuracao_MT (M);
         }
         else  break;

         if (cont == M->tempo_max) {
            printf ("\nlimite de tempo para computacao foi atingido\n");
            break;
         }
       
     } while (1);

     printf ("\ncomputacao terminada apos %d passos\n", cont);
     printf ("\nconfiguracao final:  ");
     imprime_configuracao_MT (M);
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

int  main(int argc, char **argv)
{
     struct MT  *M;

     char   arquivo[200], entrada[100];

     if (argc < 3) {
        printf ("\n  usage:  %s <arquivo> <entrada>\n", argv[0]);
        exit(0);
     }
     strcpy(arquivo,argv[1]);
     strcpy(entrada,argv[2]);

     M = malloc (sizeof(struct MT));

     carregar_MT (M, arquivo);
     imprime_definicao_MT (M);

     inicializar_MT (M, entrada);
     printf("\nconfiguracao inicial: ");
     imprime_configuracao_MT (M);
     printf("\n");

     simular_MT (M);
}
