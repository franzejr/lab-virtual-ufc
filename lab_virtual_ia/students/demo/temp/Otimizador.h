//a classe que herda de Estado deve implementar os métodos:
	//"virtual Estado()": construtor;
	//"Estado* vizinhoAleatorio()", que retorna um ponteiro para um estado vizinho aleatório;
	//"double valor()", que retorna quão bom o estado e é;
	//"Estado* melhorVizinho()", que retorna um ponteiro para o melhor vizinho segundo a função "double valor(Estado e)";
	//"void deletar()", que libera a regiao de memoria do estado.

//////////////////////////////////////////////////////////////////////

#ifndef OTIMIZADOR_H
#define OTIMIZADOR_H

#include <vector>
#include <cmath>
#include <cstdlib>
#include <ctime>
#include <cstdio>

class Estado
{
	public:
	
		virtual ~Estado(){}
	
		//métodos necessários para as otimizações
		virtual Estado* vizinhoAleatorio() = 0;

		virtual double valor() = 0;
		
		virtual Estado* melhorVizinho() = 0;
		
		virtual void deletar() = 0;
		
		
};

//////////////////////////////////////////////////////////////////////

class Otimizador
{
	public:
	
		Otimizador();
	
		virtual ~Otimizador();
		
		virtual Estado* executar();
};

Otimizador::Otimizador(){}

Otimizador::~Otimizador(){}

Estado* Otimizador::executar(){}

class HillClimbing: public Otimizador
{
	private:
		Estado *estadoAtual, *estadoDeTeste;
	public:
	
		HillClimbing(Estado* estadoInicial):
			estadoAtual(estadoAtual), estadoDeTeste(0){}
			
		virtual Estado* executar()
		{
			while(1)
			{
				estadoDeTeste = estadoAtual->melhorVizinho();
				if (estadoDeTeste->valor() > estadoAtual->valor()) estadoAtual = estadoDeTeste;
				else return estadoAtual;
			}
		}
		virtual Estado* getEstadoAtual(){return estadoAtual;}
		virtual void setEstadoAtual(Estado *e){estadoAtual = e;}
};

// *********** //

class TemperaSimulada: public Otimizador
{
	private:
		Estado *estadoAtual, *estadoDeTeste;

		double temperaturaAtual, C;
		double (*v)(int);
		int numeroMaximoIteracoes;
	public:
	
		TemperaSimulada(Estado* estadoInicial, double C, double (*v)(int), int numeroMaximoIteracoes):
			estadoAtual(estadoInicial), C(C), v(v), numeroMaximoIteracoes(numeroMaximoIteracoes){
				
			}
			
		Estado* executar()
		{
			
			srand(time(NULL));
			for (int t = 1; t <= numeroMaximoIteracoes; t++)
			{				
				temperaturaAtual = C/v(t);
				estadoDeTeste = estadoAtual->vizinhoAleatorio();
				
				if (estadoDeTeste->valor() > estadoAtual->valor())
				{
					estadoAtual->deletar();
					estadoAtual = estadoDeTeste;
				}
				else
				{
					if ( (double)(rand()%100000001)/100000000.0 < exp((estadoDeTeste->valor()-estadoAtual->valor())/temperaturaAtual))
					{
						estadoAtual->deletar();
						estadoAtual = estadoDeTeste;
					}
					else
					{
						estadoDeTeste->deletar();
					}
				}
			}
			return estadoAtual;
		}
		
		
		virtual Estado* getEstadoAtual(){return estadoAtual;}
		virtual void setEstadoAtual(Estado* e){estadoAtual = e;}
};

#endif // OTIMIZADOR_H
