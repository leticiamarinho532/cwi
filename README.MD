# Desafio Técnico

### Sumário

1. Tecnologias
2. Arquitetura/Desenho das Aplicações
3. Como usar na sua máquina
    - Clonando
    - Definindo Variáveis de Ambiente
    - Rodando
4. Testes
    - Unidade
5. Explicações de Algumas Funcionalidades


## **1. Tecnologias**
1. PHP 8.4
2. Laravel 12
3. Composer 2.x
4. MYSql 8
6. PHPUnit 11
9. Docker
10. Node.js 22
11. Express 5
12. Express-validator 7
13. Nodemon 3

## **2. Arquitetura/Desenho das Aplicações**

Na aplicaçao em node.js decidi por usar uma estrutura em camadas para haver um separação de responsabilidades. Então com os controllers, services, etc fica melhor para manutenção, legibilidade, qualidade de código entre outras boas práticas.

Na aplicação em laravel decidi por acrescentar duas camadas extras para também haver um melhor distribuição de responsabilidades. Com os services e os repositories é possivel encapsular as regras de negócio dos servicos e desencapsular a implentação do ORM eloquent das regras de negócio além de permitir, com uma inversão de depêndencia entre service e repository, realizar testes unitários.

## **3. Como usar na sua máquina**

#### Clonando
- Instale o Docker no seu local [site Docker](https://docs.docker.com/desktop/).
- Clone  esse repositório.

#### Definindo Variáveis de Ambiente
- Copie a .env.example para o arquivo .env

```
Obs: a `.env` foi disponibilizada na `.env.example` por ser tratar de um desafio técnico e para tornar a utilização mais fácil. Em caso de um projeto real, essa prática não é recomendada, pois dados sensíveis não devem ser expostos em repositorios ou outros locais públicos.
```
#### Rodando
```
Aviso: Não é necessário rodar comandos para instalar as dependências dos projetos pois já existe uma configuração automática em conjunto com as configurações do docker.
```

- Rode esse comando `docker compose up --build` na pasta raiz (onde o arquivo docker-compose.yaml está).
- Use seu Ip local, com a porta 81
- Já tem migrations prontas para uso! para utliza-las é necessário fazer o passo a passo citado no `tópico testes` para entrar no container e então rodar o comando `php artisan migrate`.

## **4. Testes**
- Unidade

    Os testes de unidade foram aplicados para assegurar comportamento correto nos menores pedaços de código, que nesse projeto se encontram nos `Services`.

    Para executar os testes, entre no container do projeto back-end usando o comando `docker exec -it ID_DO_CONTAINER bash` e utilize artisan para rodar os testes com o comando `php artisan test`.


## **5. Explicações de Algumas Funcionalidades**
- Banco de Dados

    Não foi disponibilizado um volume para o banco de dados principal `MySQL` pois da maneira utilizada, a aplicação consegue ser consultada com softwares de consulta de banco. Dessa maneira, para um projeto que ficará somente no local, é mais rápido a conclusão do mesmo.

- Logs

    Acrescentei logs (escrevendo no arquivo laravel.log) para ser possível trabalhar com algum tipo de monitoramento.
    Obs: Em aplicações reais o melhor é usar algum tipo de APM para poder realizar monitoramento e observabilidade.
