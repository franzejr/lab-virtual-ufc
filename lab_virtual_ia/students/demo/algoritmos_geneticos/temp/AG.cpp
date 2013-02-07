#include "AG.h"


vector<string> AG(vector<string> PopInicial, int iteracoes, bool convergencia, int tipoS, int taxaS, int no_pontosC, int taxaC)
{
    vector<string> Pop=PopInicial;
    double SomaAvaliacao = 0.0;

//nao faz o teste d convergencia
    if(convergencia==false)
    {
        for(int i = 0 ; i < iteracoes ; i++){


        //elitismo
            Pop = Ordena(Pop);
            string mais_adaptado = Pop[0];

            Pop = Selecao(Pop, tipoS, taxaS);
            Pop = Cruzamento(Pop, no_pontosC, taxaC);
            Pop = Mutacao(Pop);

        //elitismo
            Pop = Ordena(Pop);
            Pop.pop_back();
            Pop.push_back(mais_adaptado);
        }
    }
//faz o teste de convergencia
    else
    {
        for(int i = 0 ; i < iteracoes ; i++){


//elitismo
            Pop = Ordena(Pop);
            string mais_adaptado = Pop[0];

//teste de convergencia
            double Soma_anterior = 0.0;
            for(int j = 0; j < Pop.size(); j++)
            {
                Soma_anterior += FuncaoAvaliacao(Pop[j]);
            }

//Algoritmo Genetico em si
            Pop = Selecao(Pop, tipoS, taxaS);
            Pop = Cruzamento(Pop, no_pontosC, taxaC);
            Pop = Mutacao(Pop);

//elitismo
            Pop = Ordena(Pop);
            Pop.pop_back();
            Pop.push_back(mais_adaptado);

//teste de convergencia
            double Soma_atual = 0.0;
            for(int j = 0; j < Pop.size(); j++)
            {
                Soma_atual += FuncaoAvaliacao(Pop[j]);
            }
            if(abs(Soma_atual - Soma_anterior) < 0.0001)
            {
                return Pop;
            }
        }
    }

    return Pop;
}

vector<string> Ordena(vector<string> Pop)
{
    vector<string> NovaPopulacao;

    priority_queue< pair<double, string> > sort;

    for(int i = 0 ; i < Pop.size() ; i++)
    {
        sort.push(make_pair<double,string>(FuncaoAvaliacao(Pop[i]),Pop[i]));
    }

    for(int i = 0; i < Pop.size() ; i++)
    {
        NovaPopulacao.push_back(sort.top().second);
        sort.pop();
    }

    return NovaPopulacao;
}


//Metodo rankeado precisa d um mapeamento
vector<string> Selecao(vector<string> Pop, int tipo, int taxa)
{
    taxa = Pop.size()/2;
    vector<string> NovaPopulacao(taxa);

//rank
    if(tipo == 0)
    {
        priority_queue< pair<double, string> > sort;

        for(int i = 0 ; i < Pop.size() ; i++)
        {
            sort.push(make_pair<double,string>(FuncaoAvaliacao(Pop[i]),Pop[i]));
        }
        for(int i = 0; i < taxa ; i++)
        {
            NovaPopulacao[i] = sort.top().second;
            sort.pop();
        }
    }
//roleta
    else if(tipo == 1)
    {
        srand(time(NULL));
        double total = 0.0, sum = 0.0;

        for(int i = 0 ; i < Pop.size() ; i++)
        {
            total += FuncaoAvaliacao(Pop[i]);
        }

        int nrand, count=0;
        while(count < taxa)
        {
            int i = 0;
            sum = 0.0;
            nrand = rand()%100;
            while(sum < (double)(nrand/100))
            {
                sum += (double)(FuncaoAvaliacao(Pop[i++])/total);
            }
            NovaPopulacao[count] = (Pop[i]);
            count++;
            //cout<<"roleta"<<i<<" ="<<Pop[i]<<endl;

        }

    }
//torneio com k=2
    else
    {
        srand(time(NULL));
        int count = 0, k = 2;
        int cross[k];
        string melhor;
        while(count < taxa)
        {
            for(int i=0 ; i < k; i++)
                cross[i] = rand()%Pop.size();

            melhor = Pop[cross[0]];
            for(int i=1 ; i < k; i++)
            {
                if(FuncaoAvaliacao(melhor) < FuncaoAvaliacao(Pop[cross[i]]))
                    melhor = Pop[cross[i]];
            }

            NovaPopulacao[count] = (melhor);
            count++;
        }
    }

    return NovaPopulacao;
}


vector<string> Cruzamento(vector<string> Pop, int n_pontos, int taxa)
{
    srand(time(NULL));
    vector<string> NovaPopulacao;
    string padrao = "";
    int cross[n_pontos];

//cortes usados
    bool usado[n_pontos];
    memset(usado, false, n_pontos);

    for(int i = 0; i < n_pontos; i++)
    {
        cross[i] = rand()%Pop[0].size();
//caso nao tenha sido escolhido
        if(usado[cross[i]] == false)
            usado[cross[i]] = true;
        else
            i--;
    }

    int it = 0, it2 = 0;
    int flag = 0;
    for(int i = 0; i < n_pontos; i++)
    {
//procura ond esta o corte
        while(usado[it] == false)
            it++;

//prenche o padrao com o flag atual
        for(int j = it2; j < it; j++)
            padrao += flag;

//atualiza os iteradores e flag
        it2 = it;

        if(flag == 0)
            flag = 1;
        else
            flag = 0;
    }

    int k=0;
    for(int i = 0; i < Pop.size(); i++)
    {
        taxa = 1;
        for(int k=0; k < taxa ;k++)
        {
            int par;
            string a="", b="";
            par = rand()%Pop.size();
            for(int j=0; j<Pop[i].size(); j++)
            {
                if(padrao[j] == '0')
                {
                    a += Pop[i].at(j);
                    b += Pop[par].at(j);
                }
                else
                {
                    a += Pop[par].at(j);
                    b += Pop[i].at(j);
                }
            }

            NovaPopulacao.push_back(a);
            NovaPopulacao.push_back(b);
        }
    }


    return NovaPopulacao;
}


//colocar a probabilidade de muddar, pq nem sempre muda
vector<string> Mutacao(vector<string> Pop)
{
    srand(time(NULL));

    for(int i=0 ; i<Pop.size(); i++)
    {
        string a = Pop.at(i);
        int prob;

        for(int j=0 ; j<a.size() ; j++)
        {
           prob = rand()%100;
           if(prob<9)
           {
               if(a.at(j)=='1')
               {
                   a.at(j)='0';
               }
               else
               {
                   a.at(j)='1';
               }

           }
           Pop.at(i)=a;
        }
    }

    return Pop;
}


