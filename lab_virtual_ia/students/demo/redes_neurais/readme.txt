Como usar:

O usuário deve entrar com o nome do arquivo de entrada após o nome do programa.
O s parâmetros de treino podem ser editados na classe Main.

Formato do arquivo:

O arquivo deve conter três inteiros, que serão a altura da camada de entrada, da camada oculta e da camada de saída, respectivamente.
Após os três inteiros, o arquivo deve conter os dados de treinamento, que são um par de vetores para cada entrada do conjunto de treinamento. O primeiro vetor é o vetor de entrada, e deve ter tamanho igual à altura da camada de entrada. O segundo vetor é o vetor de saída, e deve ter tamanho igual à altura da camada de saída.
Todos os valores de treinamento devem ser normalizados entre 0 e 1.
Os valores decimais devem ser separados por vírgula.

Exemplo de arquivo de entrada:

Ex:

3
4
2

0,1 0,2 0,3
0,6 0,8

0,3 0,5 0,7
0,2 0,4

0,3 0,6 0,9
0,3 0,7


No exemplo acima temos um rede neural com 3 entradas, uma camada oculta de altura 4 e 2 saídas.

O arquivo treinamento.txt vem com o exemplo da porta XOR. Sinta-se a vontade para modificá-lo.
