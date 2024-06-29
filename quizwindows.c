#include <stdio.h>
#include <stdlib.h>


int main()
{
	system("chcp 65001");

	char resposta; //Variável que vai guardar a resposta do usuário
  	int acerto=0, erro=0, facil=0, medio=0, dificil=0, resultado=0; //Variáveis que vão guardar os pontos
  	char nome[50], continua[100]; //Variável que vai guardar o nome do usuário


  	system("cls"); //Mensagem do sistema para limpar a tela, cria dependencia com sistema operacional linux, caso usar linux substituir "clear" por "cls"

  	printf("\n\n\n\n");
    printf("\t\t      #######     ####    ####  ####  ##########  \n");
    printf("\t\t   ############   ####    ####  ####  ##########  \n");
    printf("\t\t  ####      ####  ####    ####  ####      #####   \n");
    printf("\t\t  ###        ###  ####    ####  ####     #####    \n");
    printf("\t\t  ####      ####  ####    ####  ####    #####     \n");
    printf("\t\t   #####  #####   ####    ####  ####   #####      \n");
    printf("\t\t    ############   ##########   ####  ##########  \n");
    printf("\n");
    printf("\t\t   #########         ###        ####    ########    \n");
    printf("\t\t   ##########       #####       ####   ####   ##    \n");
    printf("\t\t   ###    ###      ### ###      ####   ####         \n");
    printf("\t\t   ### #####      ###   ###     ####     ####       \n");
    printf("\t\t   ### ####      ###########    ####      ####      \n");
    printf("\t\t   ###  ####    ####     ####   ####  ##    ####    \n");
    printf("\t\t   ###   ####  ####       ####  ####  #########     \n\n");


    printf("\n \t\tDigite seu nome para começar o quiz: ");
    scanf("%s", nome);

    system("cls");

  	printf("\nNível fácil----------------------------------- \n\n"); //Exibe ao usuário qual nível está iniciando

  	//1ª questão---------------------------------------------------|

	printf("\n\t1 - 8 bits correspondem a? \n\t"); //Pergunta
	printf("\tA) 1 byte \n\t"); //------------------------|
	printf("\tB) 2 byte \n\t"); //------------------------|
	printf("\tC) 1 megabyte \n\t"); //------ Alternativas-|
	printf("\tD) 1 gigabyte \n\t"); //--------------------|
	printf("\tE) Nenhum \n\t"); //------------------------|

	scanf(" %c", &resposta); //Guardar a resposta na variável

	if((resposta == 'A' || resposta == 'a')) //Usa a condição para analisar se a resposta do usuário está correta, usando o "ou" para aceitar o caractere maiúsculo e minúsculo
	{
		printf("Você acertou! \n\t"); //Exibe a mensagem que acertou
		acerto ++; //Incrementa 1 ponto na variável acerto
		printf("Você ganhou 100 pontos. \n\t"); //Exibe ao usuário quantos pontos ele ganhou
	}

	else //Caso o usuário erre a resposta (ou mesmo digite outro caractere), vai rodar o seguinte código:
	{
		printf("Você errou! A resposta certa é a letra 'A'.\n\t"); //Exibe a mensagem que o usuário errou
		erro ++; //Incrementa 1 ponto na variável erro
		printf("Você perdeu 50 pontos. \n\t"); //Exibe quantos pontos o usuário perdeu
	}


	//Todas as proximas questões seguem o exemplo da primeira

	//2ª questão---------------------------------------------------|

	printf("\n\t2 - Qual desses é um periférico somente de saída? \n\t");
	printf("\tA) Teclado \n\t");
	printf("\tB) Monitor \n\t");
	printf("\tC) Pendrive \n\t");
	printf("\tD) VGA \n\t");
	printf("\tE) USB \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'B' || resposta == 'b')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'B'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//3ª questão---------------------------------------------------|

	printf("\n\t3 - Qual desses é um periférico somente de entrada? \n\t");
	printf("\tA) Teclado \n\t");
	printf("\tB) Monitor \n\t");
	printf("\tC) Pendrive \n\t");
	printf("\tD) VGA \n\t");
	printf("\tE) USB \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'A' || resposta == 'a')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'A'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//4ª questão---------------------------------------------------|

	printf("\n\t4 - O que quer dizer BUG? \n\t");
	printf("\tA) É a memória que facilita as tarefas e libera o processador \n \t");
	printf("\tB) É um tipo de periférico \n\t");
	printf("\tC) É um erro de programação \n\t");
	printf("\tD) É uma peça de hardware \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 100 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'C'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 50 pontos");
	}


	//5ª questão---------------------------------------------------|

	printf("\n\t5 - Um computador normalmente é composto por um conjunto de hardware, incluindo seus periféricos. Qual das alternativas a seguir NÃO é um exemplo de periférico?\n\t");
	printf("\tA) Monitor \n\t");
	printf("\tB) Leitor de digitais \n\t");
	printf("\tC) Impressora \n\t");
	printf("\tD) CPU \n\t");
	printf("\tE) Teclado \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'A'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//6ª questão---------------------------------------------------|

	printf("\n\t6 - Memória ultilizada em cartões SD \n\t");
	printf("\tA) RAM \n\t");
	printf("\tB) ROM \n\t");
	printf("\tC) Flash \n\t");
	printf("\tD) HD \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'C'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//7ª questão---------------------------------------------------|

	printf("\n\t7 - Memória somente de leitura \n\t");
	printf("\tA) RAM \n\t");
	printf("\tB) ROM \n\t");
	printf("\tC) Flash \n\t");
	printf("\tD) HD \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'B' || resposta == 'b')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'B'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//8ª questão---------------------------------------------------|

	printf("\n\t8 - Periférico de entrada e saida\n\t");
	printf("\tA) Teclado \n\t");
	printf("\tB) Tela \n\t");
	printf("\tC) Pendrive \n\t");
	printf("\tD) VGA \n\t");
	printf("\tE) USB \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'C'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	//9ª questão---------------------------------------------------|

	printf("\n\t9 - Conexão universal serial \n\t");
	printf("\tA) Teclado \n\t");
	printf("\tB) Tela \n\t");
	printf("\tC) Pendrive \n\t");
	printf("\tD) VGA \n\t");
	printf("\tE) USB \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou!  A resposta certa é a letra 'E'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}

	//10ª questão---------------------------------------------------|
	printf("\n\t10 - Não é uma memória de computador: \n\t");
	printf("\tA) HD \n\t");
	printf("\tB) RAM \n\t");
	printf("\tC) ROM \n\t");
	printf("\tD) Flash \n\t");
	printf("\tE) USB \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 100 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'E'.\n\t");
		erro ++;
		printf("Você perdeu 50 pontos. \n\t");
	}


	facil = acerto*100 - erro*50; //Aqui vai calcular os pontos do nível fácil

	printf("\t Você respondeu todas as perguntas do nivel fácil e conseguiu %d pontos. Está pronto para iniciar o nível médio?\n", facil); //Exibe os pontos e uma mensagem indicando que o usuário precisa digitar algo para continuar o programa
	scanf("%s", continua); //Usado apenas para pausar

	system("cls");

	printf("\nNível médio-----------------------------------\n\n"); //Iniciando o nível médio, as questões seguem a mesma lógica da primeira

	acerto = 0; //----------------------------------------------------------------------|
	erro = 0;   //Para passar para o nível médio essas variáveis tem que ser resetadas--|


	//1ª questão---------------------------------------------------|

	printf("\n\t1 - Qual dos itens seguintes possui memória magnética?\n\t");
	printf("\tA) Flash \n\t");
	printf("\tB) USB \n\t");
	printf("\tC) Pendrive \n\t");
	printf("\tD) HD \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'D'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}


	//2ª questão---------------------------------------------------|

	printf("\n\t2 - Qual dos itens abaixo não faz parte do HD? \n\t");
	printf("\tA) Trilha \n\t");
	printf("\tB) Setores \n\t");
	printf("\tC) Pratos \n\t");
	printf("\tD) Atuador \n\t");
	printf("\tE) Espelho pentaprismático \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'E'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}


	//3ª questão---------------------------------------------------|

	printf("\n\t3 - O acesso mais rápido é em: \n\t");
	printf("\tA) RAM\n\t");
	printf("\tB) ROM \n\t");
	printf("\tC) Registradores do computador \n\t");
	printf("\tD) CD \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'C'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}

	//4ª questão---------------------------------------------------|

	printf("\n\t4 - Em relação a segurança de informação, qual é a arquitetura cujo objetivo é promover a disponibilidade de recursos para a recuperação de dados? \n\t");
	printf("\tA) Armazenamento \n\t");
	printf("\tB) Backup \n\t");
	printf("\tC) Disposição \n\t");
	printf("\tD) Restauração \n\t");
	printf("\tE) Sustentação \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'B' || resposta == 'b')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'B'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}


	//5ª questão---------------------------------------------------|

	printf("\n\t5 - A Unidade Central de Processamento (UCP) é composta de: \n\t");
	printf("\tA) Unidade Central de Processamento e Memória de massa \n\t");
	printf("\tB) Dispositivos ou Unidades de Entrada \n\t");
	printf("\tC) Unidade central de Processamento e Memória Principal \n\t");
	printf("\tD) Unidade de Controle e Unidade de Lógica e Aritmética \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'D'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}

	//6ª questão---------------------------------------------------|

	printf("\n\t6 - Qual desses sistemas operacionais e usado em trêns: \n\t");
	printf("\tA) Windows \n\t");
	printf("\tB) Linux \n\t");
	printf("\tC) Unix \n\t");
	printf("\tD) Android \n\t");
	printf("\tE) Mac OS \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Você acertou! \n\t");
		acerto ++;
		printf("Você ganhou 200 pontos. \n\t");
	}

	else {
		printf("Você errou! A resposta certa é a letra 'C'.\n\t");
		erro ++;
		printf("Você perdeu 100 pontos. \n\t");
	}


	//7ª questão---------------------------------------------------|

	printf("\n\t7 - Medida de velocidade da CPU. \n\t");
	printf("\tA) Gb \n \t");
	printf("\tB) Kg \n \t");
	printf("\tC) GHz \n\t");
	printf("\tD) Fps \n\t");
	printf("\tE) Hz \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 200 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'C'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 100 pontos");
	}


	//8ª questão---------------------------------------------------|

	printf("\n\t8 - Programa que impede o acesso externo do PC \n\t");
	printf("\tA) Antivírus \n \t");
	printf("\tB) Firewall \n \t");
	printf("\tC) Ativação do SO \n\t");
	printf("\tD) Criptografia \n\t");
	printf("\tE) Senha \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'B' || resposta == 'b')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 200 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'B'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 100 pontos");
	}


	//9ª questão---------------------------------------------------|

	printf("\n\t9 - Variável que guarda número de grande valor: \n\t");
	printf("\tA) Public \n \t");
	printf("\tB) Private \n \t");
	printf("\tC) Int \n\t");
	printf("\tD) Long \n\t");
	printf("\tE) Boolean \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 200 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'D'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 100 pontos");
	}


	//10ª questão---------------------------------------------------|

	printf("\n\t10 - Quem foi o pai da computação? \n\t");
	printf("\tA) Allan Moore \n \t");
	printf("\tB) Steve Jobs \n \t");
	printf("\tC) Bill Gates \n\t");
	printf("\tD) Thomas Ericson \n\t");
	printf("\tE) Alan Turing \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 200 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'E'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 100 pontos");
	}


	medio = acerto*200 - erro*100; //Aqui vai calcular os pontos do nível médio

	//printf("\t Você conseguiu %d pontos no nível médio. \n", medio); //Exibe os pontos do nivel médio

	printf("\t Você respondeu todas as perguntas do nivel médio e conseguiu %d pontos. Está pronto para iniciar o nível difícil?\n", medio); //Exibe os pontos e uma mensagem indicando que o usuário precisa digitar algo para continuar o programa
	scanf(" %s", continua); //Usado apenas para pausar

	system("cls");

	printf("\nNível difícil-----------------------------------\n\n"); //Iniciando o nível difícil, as questões seguem a mesma lógica da primeira

	acerto = 0; //--------------------------------------------------|
	erro = 0;   // Novamente resetando as variáveis para continuar--|


	//1ª questão---------------------------------------------------|

	printf("\n\t1 - Quais dessas não é uma linguagem de programçao? \n\t");
	printf("\tA) Cobol \n \t");
	printf("\tB) Basica \n \t");
	printf("\tC) Smalltalk \n\t");
	printf("\tD) Preview \n\t");
	printf("\tE) Todas são \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'D'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//2ª questão---------------------------------------------------|

	printf("\n\t2 - SQL ou Linguagem de Consulta Estruturada é a linguagem padrão para consultas e alterações de dados em bancos de dados relacionados. No laboratório de qual empresa famosa de informática foi desenvolvida essa linguagem? \n\t");
	printf("\tA) Microsoft \n \t");
	printf("\tB) Apple \n \t");
	printf("\tC) Google \n\t");
	printf("\tD) Oracle \n\t");
	printf("\tE) IBM \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'E'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//3ª questão---------------------------------------------------|

	printf("\n\t 3 - Na memória principal do computador: \n\t");
	printf("\tA) Estão presentes as partes do programa e dos dados que estão sendo processados naquele momento \n \t");
	printf("\tB) Estão presentes todos os programas e dados que podem ser processados pelo computador \n \t");
	printf("\tC) Estão presentes todos os comandos que compõem uma linguagem de programação \n\t");
	printf("\tD) Estão armazenados as instruções de um único programa que está em execução naquele momento  \n\t");
	printf("\tE) Nenhuma \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'A' || resposta == 'a')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'A'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//4ª questão---------------------------------------------------|

	printf("\n\t 4 - O framework com designação universal abstrata para localizar um recurso na internet ou na intranet é: \n\t");
	printf("\tA) URL \n \t");
	printf("\tB) HTTP \n \t");
	printf("\tC) HTTPS \n\t");
	printf("\tD) TCP/IP \n\t");
	printf("\tE) Nome do arquivo \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'A' || resposta == 'a')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'A'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//5ª questão---------------------------------------------------|

	printf("\n\t 5 - Ao realizar uma cópia de segurança (backup) com objetivo de impossibilitar o acesso por qualquer pessoa deve-se utilizar do recurso de: \n\t");
	printf("\tA) Ciclografia \n \t");
	printf("\tB) Halografia \n \t");
	printf("\tC) Diagrafia \n\t");
	printf("\tD) Eletrografia \n\t");
	printf("\tE) Criptografia \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'E' || resposta == 'e')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'E'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//6ª questão---------------------------------------------------|

	printf("\n\t 6 - Em que ano surgiu a linguagem de programação C? \n\t");
	printf("\tA) 1975 \n \t");
	printf("\tB) 1996 \n \t");
	printf("\tC) 2000 \n\t");
	printf("\tD) 1972 \n\t");
	printf("\tE) 1987 \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'D' \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}

	//7ª questão---------------------------------------------------|

	printf("\n\t 7 - Em modo de espera, quais componentes ficam ligados? \n\t");
	printf("\tA) Placa mãe, processador, monitor \n \t");
	printf("\tB) Placa mãe, HD, monitor \n \t");
	printf("\tC) Placa mãe, memória RAM \n\t");
	printf("\tD) Placa mãe, placa de rede, modem, memória RAM \n\t");
	printf("\tE) Nenhum \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'D'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}

	//8ª questão---------------------------------------------------|

	printf("\n\t 8 - O primeiro dominio registrado na internet foi: \n\t");
	printf("\tA) www.datacenter.com \n \t");
	printf("\tB) www.symbolics.com \n \t");
	printf("\tC) www.social.com \n\t");
	printf("\tD) www.us.gov \n\t");
	printf("\tE) www.people.com \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'B' || resposta == 'b')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'B'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//9ª questão---------------------------------------------------|

	printf("\n\t 9 - 4GB de memória RAM possui: \n\t");
	printf("\tA) 2048 MB de memória não volátil  \n \t");
	printf("\tB) 4000 MB de memória volátil \n \t");
	printf("\tC) 4096 MB de memória volátil \n\t");
	printf("\tD) 4000 MB de memória não volátil \n\t");
	printf("\tE) 4124 GB de memória volátil \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'C' || resposta == 'c')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'C'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}


	//10ª questão---------------------------------------------------|

	printf("\n\t 10 - O que quer dizer a sigla 'UML'? \n\t");
	printf("\tA) Unique Modeling Language \n \t");
	printf("\tB) Unified Moving Language \n \t");
	printf("\tC) Unknown Moving Language \n\t");
	printf("\tD) Unified Modeling Language \n\t");
	printf("\tE) Unique Marvin Long \n\t");

	scanf(" %c", &resposta);

	if((resposta == 'D' || resposta == 'd')) {
		printf("Vocẽ acertou! \n\t");
		acerto ++;
		printf("Vocẽ ganhou 300 pontos. \n\t");

	}

	else {
		printf("Vocẽ errou! A resposta certa é a letra 'D'. \n\t");
		erro ++;
		printf("Vocẽ perdeu 150 pontos");
	}

	//Resto das questões do nível difícil

	dificil = acerto*300 - erro*150; //Aqui vai calcular os pontos do nível difícil

	printf("\t Você conseguiu %d pontos no nível difícil. \n", dificil); //Exibe os pontos do nivel difícil

	printf("\n Parabéns %s, você respondeu todas as questões do quiz, está pronto para ver seu resultado?", nome);
	scanf("%s", continua);

	system("cls");

	resultado = facil + medio + dificil; //Calcula os pontos totais



	if(resultado == 6000) // Caso acerte todas as questões 6000 pontos é a máxima pontuação
	{
 printf("\n           #                #                #                #                #            \n");                     
   printf("          ###              ###              ###              ###              ###           \n");           
   printf("    ###############  ###############  ###############  ###############  ###############     \n");  
   printf("      ###########      ###########      ###########      ###########      ###########       \n");     
   printf("        #######          #######          #######          #######          #######         \n");       
   printf("       #########        #########        #########        #########        #########        \n");      
   printf("      ##       ##      ##       ##      ##       ##      ##       ##      ##       ##       \n");
		printf("\n\t\t Parabéns, você acertou todas as questões e tirou no total de %d pontos!\n ", resultado); // Mostra a pontuação
	}

	else if(resultado >= 5000 && resultado < 6000) //Se acertar quase todas as questões
	{
 printf("\n           #                #                #                #         \n");                     
   printf("          ###              ###              ###              ###        \n");           
   printf("    ###############  ###############  ###############  ###############  \n");  
   printf("      ###########      ###########      ###########      ###########    \n");     
   printf("        #######          #######          #######          #######      \n");       
   printf("       #########        #########        #########        #########     \n");      
   printf("      ##       ##      ##       ##      ##       ##      ##       ##    \n");
		printf("\n\t\t Ótimo, você acertou quase todas as questões e tirou no total de %d pontos!\n ", resultado); // Mostra a pontuação
	}

	else if(resultado >= 3000 && resultado < 5000) //Se acertar muitas questões
	{
 printf("\n           #                #                #          \n");                     
   printf("          ###              ###              ###         \n");           
   printf("    ###############  ###############  ###############   \n");  
   printf("      ###########      ###########      ###########     \n");     
   printf("        #######          #######          #######       \n");       
   printf("       #########        #########        #########      \n");      
   printf("      ##       ##      ##       ##      ##       ##     \n");
		printf("\n\t\t Muito bom, você acertou muitas questões e tirou no total de %d pontos!\n ", resultado); // Mostra a pontuação
	}

	else if(resultado >= 1000 && resultado < 3000) // Se acertar algumas questões
	{
 printf("\n           #                #           \n");                     
   printf("          ###              ###          \n");           
   printf("    ###############  ###############    \n");  
   printf("      ###########      ###########      \n");     
   printf("        #######          #######        \n");       
   printf("       #########        #########       \n");      
   printf("      ##       ##      ##       ##      \n");
		printf("\n\t\t Bom, você acertou algumas questões e tirou no total de %d pontos!\n ", resultado); // Mostra a pontuação
}

	else if(resultado < 1000) //Se errar muitas questões
	{
 printf("\n           #             \n");                     
   printf("          ###            \n");           
   printf("    ###############      \n");  
   printf("      ###########         \n");     
   printf("        #######          \n");       
   printf("       #########        \n");      
   printf("      ##       ##         \n");
		printf("\n\t\t Precisa estudar mais, você errou muitas questões e tirou no total de %d pontos!\n ", resultado); // Mostra a pontuação
}

	else if(resultado < -3000 || resultado > 6000) //Caso não dê nenhum valor entre -3000 (pontuação mínima) e 6000 (máxima)
	{
		printf("======================================================================================================================================================");
		printf("\n\n\n\t\t\t\t\t\t E R R O! \n\n\n");
		printf("======================================================================================================================================================\n");

	}

	return 0;

}
