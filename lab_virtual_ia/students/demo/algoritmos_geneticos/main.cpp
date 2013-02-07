#include "AG.h"
#include<fstream>
#include<iostream>
using namespace std;

int main()
{
    srand(time(NULL));

    vector<string> teste;

    int inteira, fracionada, sinal;

    for(int i=0; i<200; i++)
    {
        double* result;
        result = new double[2];
        string num = "";
        sinal = rand()%1;
        inteira = rand()%7;
        if(sinal == 1)
            inteira *= -1;

        fracionada = rand()%99;
        num += DoubleToString((double)inteira);
        num += ".";
        num += DoubleToString((double)fracionada);
        result[0] = StringToDouble(num);

//segundo numero
        num = "";
        sinal = rand()%1;
        inteira = rand()%7;
        if(sinal == 1)
            inteira *= -1;

        fracionada = rand()%99;
        num += DoubleToString((double)inteira);
        num += ".";
        num += DoubleToString((double)fracionada);
        result[1] = StringToDouble(num);

        teste.push_back(Codificar(result));
    }
    int cont=1;
    cout << "Teste" <<endl;
    for(int i = 0 ; i < 150 ; i ++){
        teste = AG(teste, 1, false, 0, 0, 3, 0);

        double* aux;
        for(int j = 0; j < teste.size(); j++)
        {
            aux = Decodificar(teste[j]);
            if(i%10 == 0){

                cout<<aux[0]<<"   "<<aux[1]<<"   "<<FuncaoAvaliacao(teste[j])<<endl;
                cont++;
            }
        }
    }

    cout << "Terminado" << endl;

    return 0;
}
