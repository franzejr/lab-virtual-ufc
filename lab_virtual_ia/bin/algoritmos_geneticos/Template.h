#ifndef TEMPLATE_H
#define TEMPLATE_H


#include<iostream>
#include<string>
#include<vector>
#include<sstream>
#include<cmath>
#include<algorithm>

using namespace std;

//Funcao Fitness
double FuncaoAvaliacao(string codificacao);
//Codifica para uma string de binarios
string Codificar(double *cromo);
//Decodifica da string para valor real
double* Decodificar(string codigo);


//Auxiliares
string DoubleToString(double num);
double StringToDouble(string str);
string DecToBin(int num);

vector<string> PopulacaoInicial();

#endif // TEMPLATE_H
