#include <cstdlib>
#include <ctime>
#include <cmath>
#include <cstdio>

#include "Otimizador.h"

double value(int t)
{
	return sqrt((double)t);
}

class Posicao : public Estado
{
	public:
		int x,y;
		
		Posicao()
		{}
		
		Posicao(int x, int y):x(x),y(y){}
			
		//métodos necessários para as otimizações
		Estado* vizinhoAleatorio()
		{
			int random = rand()%4;
			
			if (random == 0) return new Posicao(x+1,y);
			else if (random == 1) return new Posicao(x,y+1);
			else if (random == 2) return new Posicao(x-1,y);
			else if (random == 3) return new Posicao(x-1,y-1);
		}
		
		double valor(){
			return -2.0*pow((double)x,2.0)-3.0*pow((double)y,2.0)+14.0*((double)x)+23.0*((double)y)+20.0;
		}
		
		Estado* melhorVizinho(){
			//TODO
			return this;
		}
		
		void deletar()
		{
			free(this);
		}
};

int main( int argc, char **argv ){

	srand(time(NULL));
	
	Posicao *posicao = new Posicao(1000, 1000);
	
	TemperaSimulada *tempera = new TemperaSimulada(posicao, 1000.0, value, 900);
	
	tempera->executar();
	printf("x = %d; y = %d",posicao->x,posicao->y);
	
	return 0;
	
}
