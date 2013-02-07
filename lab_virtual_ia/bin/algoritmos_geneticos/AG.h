#ifndef AG_H
#define AG_H

#include <string>
#include <iostream>
#include <stdlib.h>
#include <vector>
#include<time.h>
#include<queue>
#include"Template.h"
#include<cstring>

vector<string> Selecao(vector<string> Pop, int tipo, int taxa);
vector<string> Cruzamento(vector<string> Pop, int n_pontos, int taxa);
vector<string> Mutacao(vector<string> Pop);
vector<string> AG(vector<string> PopInicial, int iteracoes, bool convergencia, int tipoS, int taxaS, int no_pontosC, int taxaC);
vector<string> Ordena(vector<string> Pop);

#endif // AG_H
