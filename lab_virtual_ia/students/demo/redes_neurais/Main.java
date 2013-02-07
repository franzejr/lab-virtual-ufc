import java.io.*;
import java.util.Scanner;

public class Main {
	
	public static void main(String[] args) throws Exception{
		runInterface();
	}
	
	
	private static void runInterface() throws Exception{
		Parser parser = new Parser(new File("../treinamento.txt"));
		
		NeuralNetwork NN = new NeuralNetwork(parser.getN1(), parser.getN2(), parser.getN3());
		
		Patterns p = parser.getPatterns();
		
		Scanner ler = new Scanner(System.in);
		
		/* Parametros */
		double erroAceitavel = 0.01, taxaAPrendizado = 0.2, momentum = 0.1;
		int numEpocas = 100000;
		
				
		
		System.out.println("A rede sera treinada com os seguintes parametros:\n" +
				"Taxa de aprendizado. Valor atual: "+taxaAPrendizado+"\n"+
				"Numero de epocas. Valor atual: "+numEpocas+"\n"+
				"Momentum. Valor atual: "+ momentum + "\n"+
				"Erro aceitavel (para calculo de estatisticas). Valor atual:"+erroAceitavel+"\n");
			
		
		
		
		NN.train(p, numEpocas, taxaAPrendizado, momentum);
		
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
