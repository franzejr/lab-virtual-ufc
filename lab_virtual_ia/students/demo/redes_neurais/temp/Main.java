import java.io.*;
import java.util.Scanner;

public class Main {

	
	// Split: valor real de 0 a 1. Determina a porcentagem de padroes utilizados
	// no conjunto de treinamento. O restante dos valores serao utilizados no conjunto
	// de testes. 1.0 significa que a rede sera treinada com todos os padroes disponiveis.
	
	static double split = 1.0;
	
	// Taxa de aprendizado: Determina a ordem de grandeza da atualizacao dos pesos.
	// Quando maior, mais rapida sera a convergencia para a solucao, porem a precisao
	// sera menor.
	
	static double taxaAprendizado = 0.1;
	
	// Numero de Epocas: Quantidade de vezes que a rede sera treinada baseando-se
	// no conjunto de treinamento. Quanto mais, melhor.
	
	static int numEpocas = 100000;	
	
	// Momentum: tem por objetivo aumentar a velocidade de treinamento da rede
	// neural e reduzir o perigo de instabilidade. Este termo pode ou nao ser utilizado durante o
	// treinamento e seu valor varia de 0.0 (nao utilizacao) a 1.0. O valor recomendado para o termo
	//momentum E 0.3

	
	static double momentum = 0.3;
	
	// Erros maiores que o valor abaixo nao serao considerados como acertos. Serve para
	// o calculo de estatisticas.
	
	static double erroAceitavel = 0.01;
	
	
	
	public static void main(String[] args) throws Exception{
		runInterface(args);
	}
	
	
	private static void runInterface(String[] args) throws Exception{
		Parser parser = new Parser(new File(args[0]));
		
		NeuralNetwork NN = new NeuralNetwork(parser.getN1(), parser.getN2(), parser.getN3());
		
		NN.setSplit(split);
		
		Patterns p = parser.getPatterns();
		
		Scanner ler = new Scanner(System.in);
		
		
		
		/*
		while(true){
			
			System.out.println("Defina a % de split no intervalo real [0,100] :");	
			
			double split = ler.nextDouble();
			
			if((split >= 0)&&(split <= 100)){
				
				split = split /100;
				
				NN.setSplit(split);
				
				break;				
			}
			else{
				
				System.out.println("O split deve estar no intervalo [0,100]!");
				
			}
		}
		
		
		System.out.println("Deseja alterar algum parametro de treinamento?:\n" +
				"1 - Alterar taxa de aprendizado. Valor atual: "+taxaAPrendizado+"\n"+
				"2 - Alterar numero de Epocas. Valor atual: "+numEpocas+"\n"+
				"3 - Alterar momentum. Valor atual: "+ momentum + "\n"+
				"4 - Alterar erro aceitavel (para calculo de estatisticas). Valor atual: "+erroAceitavel+"\n"+
				"5 - Nao desejo alterar parametros. Treinar a rede agora.");
			
		int escolha = ler.nextInt();
		boolean loopControl = true;
		while(loopControl){
			switch(escolha){
			case 1:
				System.out.println("Entre com a nova taxa de aprendizado:");
				taxaAPrendizado = ler.nextDouble();
				break;
			case 2:
				System.out.println("Entre com o novo numero de Epocas:");
				numEpocas = ler.nextInt();
				break;
			case 3:
				System.out.println("Entre com o novo momentum:");
				momentum = ler.nextDouble();
				break;
			case 4:
				System.out.println("Entre com o novo erro aceitavel:");
				erroAceitavel = ler.nextDouble();
				break;
			case 5:
				loopControl = false;				
			}
			if(loopControl == false) break;
			System.out.println("Deseja alterar algum parametro de treinamento?:\n" +
					"1 - Alterar taxa de aprendizado. Valor atual: "+taxaAPrendizado+"\n"+
					"2 - Alterar numero de Epocas. Valor atual: "+numEpocas+"\n"+
					"3 - Alterar momentum. Valor atual: "+ momentum + "\n"+
					"4 - Alterar erro aceitavel (para calculo de estatisticas). Valor atual: "+erroAceitavel+"\n"+
					"5 - Nao desejo alterar parametros. Treinar a rede agora.");
				
			escolha = ler.nextInt();
		}
		
		*/
		
		
		
		NN.train(p, numEpocas, taxaAprendizado, momentum);
		
		double erro = 0, total = 0, sum = 0 ;
		
		int splitTeste = (int)(p.getNumPatterns()*NN.getSplit());
		
		System.out.println("Resultados para o conjunto de treinamento: ");
		
		for(int i = 0; i < p.getNumPatterns(); i++){
			
			if(splitTeste == i){
				
				System.out.println("Erro no conjunto de treinamento: "+((erro/total)*100)+"%\n\n");
				
				System.out.println("Resultados para o conjunto de teste: ");
				
				erro = 0;
				
				total = 0;
				
			}
			
			total++;
			
			for(int j = 0; j < NN.getN1(); j++){
				
				System.out.print(p.getInputPattern(i)[j]+", ");
				
			}
			System.out.print(" -> ");			
			
			sum = 0;
			
			for(int j = 0; j < NN.getN3(); j++){
				
				System.out.print(NN.update(p.getInputPattern(i))[j]+", ");
				
				sum = sum + Math.abs(NN.update(p.getInputPattern(i))[j] - p.getOutputPattern(i)[j]);
			}
			
			if(sum/NN.getN3() > erroAceitavel) erro++;
			
			System.out.println("     erro: "+ (sum/NN.getN3()));
		}
		System.out.println("Erro no conjunto de teste: "+((erro/total)*100)+"%");
	}
}
