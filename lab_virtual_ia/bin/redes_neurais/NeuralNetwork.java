import java.lang.Math;

public class NeuralNetwork
{
        // Number of nodes for each layer.
        private int n1 = 0;
        private int n2 = 0;
        private int n3 = 0;
        
        private double split = 1;
        
        // Activation arrays.
        private double[] a1 = null;
        private double[] a2 = null;
        private double[] a3 = null;
        
        // Linear transformation from l1 to l2 and from l2 to l3, respectively.
        private double[][] wi = null;
        private double[][] wo = null;
        
        // Momentum
        private double[][] ci = null;
        private double[][] co = null;
        
        private double rand( double a, double b )
        {
                return ( b - a ) *Math.random()  + a;
        }
        
        public NeuralNetwork( int n1, int n2, int n3 )
        {
                this.n1 = n1 + 1;       // Including Bias input.
                this.n2 = n2;
                this.n3 = n3;
                
                wi = new double[ this.n1 ][ this.n2 ];
                wo = new double[ this.n2 ][ this.n3 ];
                
                a1 = new double[ this.n1 ];
                a2 = new double[ this.n2 ];
                a3 = new double[ this.n3 ];
                
                ci = new double[this.n1][this.n2];
                co = new double[this.n2][this.n3];
                
                
                for( int i = 0; i < a1.length; i++ )
                {
                        a1[i] = 1.0;
                }
                
                for( int i = 0; i < a2.length; i++ )
                {
                        a2[i] = 1.0;
                }
                
                for( int i = 0; i < a3.length; i++ )
                {
                        a3[i] = 1.0;
                }
                
                // Populating matrices with random values between 0 and 1.
                for( double[] r : wi )
                {
                        for( int i = 0; i < r.length; i++ )
                        {
                                r[i] = rand( -0.2, 0.2 );
                        }
                }
                
                for( double[] r : wo )
                {
                        for( int i = 0; i < r.length; i++ )
                        {
                                r[i] = rand( -2.0, 2.0 );
                        }
                }
                
        }
        
        public double getOutput( int index ) throws Exception
        {
                if( index >= a3.length )
                {
                        throw new Exception( "NeuralNetwork: ilegal index." );
                }
                
                return a3[index];
        }
        
        // Sigmoid function.
        private double sigmoid( double x )
        {
                return Math.tanh( x );
        }
        
        // Derivative of sigmoid function.
        private double dSigmoid( double x )
        {
                return 1 - Math.pow(x, 2);
        }
        
        public double[] update( double[] inputs ) throws Exception
        {
                if( inputs.length != n1 - 1 )
                {
                        throw new Exception( "NeuralNetwork: wrong number of inputs." );
                }
                
                // Input activations.
                for( int i = 0; i < n1 - 1; i++ )
                {
                        a1[i] = inputs[i];
                }
                
                double sum = 0.0;
                
                // Hidden activations.
                for( int j = 0; j < n2; j++ )
                {
                        sum = 0.0;
                        
                        for( int i = 0; i < n1; i++ )
                        {
                                sum += a1[i] * wi[i][j];
                        }
                        
                        a2[j] = sigmoid( sum );
                }
                
                // Output activations.
                for( int k = 0; k < n3; k++ )
                {
                        sum = 0.0;
                        
                        for( int j = 0; j < n2; j++ )
                        {
                                sum += a2[j] * wo[j][k];
                        }
                        
                        a3[k] = sigmoid( sum );
                }
                
                return a3;
        }
        
        public double backPropagate( double[] targets, double N, double M ) throws Exception
        {
        	
        	if(targets.length != n3)
        		throw new Exception("NeuralNetwork: wrong number of outputs.");
        	
        	        	
        	double error;
        	
        	//Calcular o erro para a camada de saida
        	
        	double[] output_deltas = new double[n3];
        	
        	for(int k = 0; k < n3; k++)
        	{
        		error = targets[k] - a3[k];
        		
        		output_deltas[k] = dSigmoid(a3[k])*error;       		
        	}
        	
        	
        	//Calcular o erro para a camada oculta
        	
        	double[] hidden_deltas = new double[n2];
        	
        	for(int j = 0; j < n2; j++)
        	{        		
        		error = 0;
        		
        		for(int k = 0; k < n3; k++)
        			error = error + output_deltas[k]*wo[j][k];
        		
        		hidden_deltas[j] = dSigmoid(a2[j])*error;
        	}
        	
        	
        	//Atualizar os pesos de saida
        	
        	double alteracao;
        	
        	for(int j = 0; j < n2; j++)
        	{
        		for(int k = 0; k < n3; k++)
        		{
        			alteracao = output_deltas[k]*a2[j];
        			
        			wo[j][k] = wo[j][k] + N*alteracao + M*co[j][k]; 
        			
        			co[j][k] = alteracao;
        		}
        	}
        	
        	
        	//Atualizar os pesos de entrada
        	
        	for(int i = 0; i < n1; i++)
        	{
        		for(int j = 0; j < n2; j++)
        		{
        			alteracao = hidden_deltas[j]*a1[i];
        			
        			wi[i][j] = wi[i][j] + N*alteracao + M*ci[i][j];
        			
        			ci[i][j] = alteracao;
        		}
        	}
        	
        	//Calcular erro
        	
        	error = 0.0;
        	
        	for(int k = 0; k < targets.length; k++)
        		error = error + 0.5*Math.pow((targets[k] - a3[k]), 2);
        	
        	
        	
        	return error;
        }
        
        
        public void train(Patterns pat, int iterations , double n, double m) throws Exception
        {
        	// n -> learning rate
        	
        	// m -> momentum
        	
        	double error;
        	
        	double[] inputs = null;
        	
        	double[] targets = null;
        	
        	int numPatSplit = (int)(pat.getNumPatterns()*split);
        	
        	for(int i = 0; i < iterations; i++)
        	{
        		error = 0;
        		
        		for(int j=0; j < numPatSplit; j++)
        		{
        			inputs = pat.getInputPattern(j);
        			
        			targets = pat.getOutputPattern(j);
        			
            		try
            		{
            			this.update(inputs);
            		}
            		
            		catch (Exception e)
            		{
            			throw e;
    				}
            		
            		error = error + this.backPropagate(targets, n, m);
        		}
        		
        		if(i%100 == 0)
        		{
        			//System.out.println("error: " + error);
        		}
        	}
        }
        
        public void setSplit(double split)
        {
        	this.split = split;
        }
        
        public double getSplit(){
        	return split;
        }
        
        public int getN1()
        {
			return n1-1;
        	
        }
        
        public int getN3()
        {
        	return n3;
        }
        
        
        
        
        
        
}
