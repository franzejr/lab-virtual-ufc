import java.io.*;
import java.util.*;

public class Parser {
    private int n1 = 0;
    private int n2 = 0;
    private int n3 = 0;
    
    private Patterns patterns = null;
    
    public Parser( File file )
    {
            Scanner scn = null;
            
            try
            {
                    scn = new Scanner( new FileReader( file ) );
            }
            
            catch( Exception e )
            {
                    System.err.println( e );
            }
            
            n1 = scn.nextInt();
            n2 = scn.nextInt();
            n3 = scn.nextInt();
                            
            //System.out.println( "Li a primeira linha" );
            
            patterns = new Patterns( n1, n3 );
            
            //System.out.println( scn.next() );
            
            double[] in = null, out = null;
            while( scn.hasNextDouble() )
            {
                    in = new double[n1];
                    
                    for( int i = 0; i < n1; i++ )
                    {
                            in[i] = scn.nextDouble();
                            
                            //System.out.println( "li um double" );
                    }
                    
                    out = new double[n3];
                    
                    //System.out.println( scn.next() );
                    
                    for( int i = 0; i < n3; i++ )
                    {
                            out[i] = scn.nextDouble();
                            
                            //System.out.println( "li um double" );
                    }
                    
                    try
                    {
                            patterns.addPattern( in, out );
                    }
                    
                    catch( Exception e )
                    {
                            System.err.println( e );
                    }
            }
    }
    
    public int getN1()
    {
            return n1;
    }
    
    public int getN2()
    {
            return n2;
    }
    
    public int getN3()
    {
            return n3;
    }
    
    public Patterns getPatterns()
    {
            return patterns;
    }
    
    public static void main( String[] args )
    {
            if( args.length != 1 )
            {
                    System.out.println( "Nome do arquivo." );
                    
                    return;
            }
            
            Parser par = new Parser( new File( args[0] ) );
            
            Patterns p = par.getPatterns();
            
            System.out.println( "n1: " + par.getN1() );
            System.out.println( "n2: " + par.getN2() );
            System.out.println( "n3: " + par.getN3() );
            
            for( int i = 0; i < p.getNumPatterns(); i++ )
            {
                    for( double d : p.getInputPattern( i ) )
                    {
                            System.out.print( d + " " );
                    }
                    
                    System.out.println( " " );
                    
                    for( double d : p.getOutputPattern( i ) )
                    {
                            System.out.print( d + " " );
                    }
                    
                    System.out.println( " " );
            }
    }

}
