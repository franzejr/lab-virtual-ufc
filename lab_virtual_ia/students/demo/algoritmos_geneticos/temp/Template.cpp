#include "Template.h"

double* Decodificar(string cod);



double FuncaoAvaliacao(string codificacao)
{
    double result, x, y;
    double* aux = Decodificar(codificacao);
    x = aux[0];
    y = aux[1];
    //result = pow((1 - x), 2) + 100*pow((y - pow(x, 2)), 2);
    result = 3*(1-x)*(1-x)*exp(-(x*x) - (y+1)*(y+1)) - 10*(x/5 - x*x*x - y*y*y*y*y)*exp(-x*x-y*y) - 1/3*exp(-(x+1)*(x+1) - y*y);
    //result = sin(x) + cos(y);
    //cout<<"r="<<result<<endl;
    return result;
}

string DoubleToString(double num)
{
    string Result;
    stringstream convert;
    convert << num;

    Result = convert.str();

    return Result;
}

double StringToDouble(string str)
{
    double Result;

    stringstream convert(str);

    if ( !(convert >> Result) )
        Result = 0;

     return Result;
}

string DecToBin(int num)
{
    int resto;
    string result="";
    while(num!=0)
    {
        resto = num%2;
        num = num/2;
        if(resto == 1)
            result += "1";
        else
            result += "0";

    }

    reverse(result.begin(), result.end());

    return result;
}

string Codificar(double *cromo)
{
    string a="", a1, a2, a3;
    string b="", b1, b2, b3;

    //flag do sinal
    if(cromo[0]>=0)
        a1 = "0";
    else
        a1 = "1";

    int ParteInteira = cromo[0];
    double ParteFracionada;

    //parte fracionada
    string aux = DoubleToString(abs(cromo[0]));
    aux.erase(0,2);//exclui a parte inteira;
    ParteFracionada = StringToDouble(aux);
    a3 = DecToBin((int)ParteFracionada);

    string n_zeros = "";
    for(int i=0; i<7-a3.size();i++)
    {
        n_zeros += "0";
    }
    a3 = n_zeros+a3;
    //cout<<a3<<endl;

    //parte inteira
    a2 = DecToBin(abs(ParteInteira));
    if(a2.size()==1)
        a2 = "00"+a2;
    else if(a2.size()==2)
        a2 = "0"+a2;
    else if(ParteInteira == 0)
        a2 = "000";

    a = a1+a2+a3;

    //cout<<"a = "<<a<<endl;

    //cromox2
    if(cromo[1]>=0)
        b1 = "0";
    else
        b1 = "1";

    ParteInteira = (int)cromo[1];
    //ParteFracionada;

    //parte fracionada
    aux = DoubleToString(abs(cromo[1]));
    aux.erase(0,2);//exclui a parte inteira;
    ParteFracionada = StringToDouble(aux);
    b3 = DecToBin((int)ParteFracionada);

    n_zeros = "";
    for(int i=0; i<7-b3.size();i++)
    {
        n_zeros += "0";
    }
    b3 = n_zeros+b3;
    //cout<<a3<<endl;

    //parte inteira
    b2 = DecToBin(abs(ParteInteira));
    if(b2.size()==1)
        b2 = "00"+b2;
    else if(b2.size()==2)
        b2 = "0"+b2;
    else if(ParteInteira == 0)
        b2 = "000";

    b = b1+b2+b3;

    //cout<<"b = "<<b<<endl;

    return (a+b);
}

double* Decodificar(string codigo)
{
    double aux1 = 0.0, aux2 = 0.0;
    string a="", a1, a2, a3;

//apos a virgula
    for(int i=4; i<codigo.size()/2; i++)
    {
        if(codigo[i] == '1')
            aux1 += pow(2, codigo.size()/2-i-1);
    }
    a3 = DoubleToString(aux1);

//ants da virgula
    int j=2;
    for(int i=1; i<4; i++)
    {
        if(codigo[i] == '1')
            aux2 += pow(2, j);
        j--;
    }
    a2 = DoubleToString(aux2);
    a2 += ".";

//flag do sinal
    if(codigo[0] == '0')
        a1 = "+";
    else
        a1 = "-";


    a = a1+a2+a3;
    double* result;

    result = new double[2];
    result[0] = StringToDouble(a);


//segundo double
    codigo = codigo.erase(0, 11);
    aux1 = 0.0;
    aux2 = 0.0;
    string b="", b1, b2, b3;

//apos a virgula
    for(int i=4; i<codigo.size(); i++)
    {
        if(codigo[i] == '1')
            aux1 += pow(2, codigo.size()-i-1);
    }
    b3 = DoubleToString(aux1);

//ants da virgula
    j=2;
    for(int i=1; i<4; i++)
    {
        if(codigo[i] == '1')
            aux2 += pow(2, j);
        j--;
    }
    b2 = DoubleToString(aux2);
    b2 += ".";

//flag do sinal
    if(codigo[0] == '0')
        b1 = "+";
    else
        b1 = "-";


    b = b1+b2+b3;
    result[1] = StringToDouble(b);

    return result;
}

