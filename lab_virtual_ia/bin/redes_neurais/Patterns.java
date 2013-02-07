
import java.util.ArrayList;

public class Patterns 
{
	
	private ArrayList<double[]> inputPattern= null;
	private ArrayList<double[]> outputPattern= null;
	private int numInput;
	private int numOutput;
	private int numPatterns;
	
	
	public Patterns(int n1, int n3)
	{
		this.numInput = n1;
		this.numOutput = n3;
		this.inputPattern = new ArrayList<double[]>();
		this.outputPattern = new ArrayList<double[]>();
		this.numPatterns = 0;
		
	}
	
	
	public double[] getInputPattern(int i)
	{
		return inputPattern.get(i);
	}
	
	public double[] getOutputPattern(int i)
	{
		return outputPattern.get(i);
	}
	
	public int getNumPatterns() {
		return numPatterns;
	}
	
	
	public void addPattern(double[] inpattern, double[] outpattern) throws Exception
	{
		if( (inpattern.length != numInput) || (outpattern.length != numOutput) )
		{
			throw new Exception("Patterns: input/output array length doesn't match.");
		}

		else
		{
			inputPattern.add(inpattern);
			outputPattern.add(outpattern);
			numPatterns++;
		}
	}
	

}
