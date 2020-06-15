# prova-qa-kinghost

## _Propósito_

O propósito deste repositório é armazenar a implementação e documentação da solução do seguinte problema proposto: https://github.com/kinghost/prova-qa.  

---

## _Sumário_

Esse documento está organizado em seções, estas podem ser vistas abaixo:

- Seção 1: Decisões e Tecnologias
- Seção 2: Implementações
- Seção 3: Execução da solução
 
 ---
 ### _Seção 1: Decisões e Tecnologias_
 
 Esta seção abordará decisões tomadas e tecnologias aplicadas na solução de modo cronológico, sendo assim, também é possível avaliar como os dois principais tópicos desta seção se relacionam com tempo e sua gerencia. Ademais, é necessário informar que os tópicos serão apresentado no seguinte formato: 
 
 - Decisão/Tecnologia: 
    - motivação. 
 
 
 ##### _11/06/2020_
 
 1. Implementação básica dos testes.
    1. Tendo em vista que a prioridade de entrega era a implementação de testes, o primeiro passo foi estudar como fazer a implementação dos mesmos.
 2. PHPUnit
    2. Teste de unidade é um método pelo qual pequenas unidades de código são testadas em relação aos seus resultados esperados. Com estes, testamos cada componente do código individualmente. Testar em um escopo pequeno, implica em maior rastreabilidade de erros. Sendo assim, a maior vantagem dessa abordagem é a facilidade de detecção de erros no principio do desenvolvimento e no decorrer deste, como em novas funcionalidades que se modificam o código pré existente. O PHPUnit é uma biblioteca independente de framework para testes unitários em PHP. Este contém uma vasta documentação e é suportado por diversas IDEs do PHP, incluindo o PHPStorm (utilizado para esta solução devido a prévia familiaridade). Portanto, esta tecnologia foi escolhida para viabilizar a implementação de testes unitários devido aos benefícios supracitados.
 3. Composer
    3. De modo a simplificar a instalação/atualização de dependências se fez necessário um gerenciador de dependências. O Composer é uma ferramenta para gerenciamento de dependências em PHP, este facilita a manutenção de bibliotecas de fornecedores fora do seu repositório, o que significa que apenas o código do aplicativo entra no repositório git. Sendo assim, foi escolhido o Composer como gerenciador de dependências.
 4. Versão das tecnologias
    4.  Devido aos novos recursos e aprimoramentos providos por versões latest, se escolheu utilizar esta para todas as tecnologias utilizadas.

 ##### _13/06/2020_
 
 1. Implementação da pipeline para CI.
    1. Considerando que o básico esperado já havia sido desenvolvido, então o estudo e implementação acerca da pipelines (CI/CD) foi o passo seguinte. 
 2. GitLab
    2. A Integração Contínua (Continuous Integration - CI), funciona através do envio de pequenos pedaços de código para a base de código de um projeto, hospedada em um repositório, e a cada envio é executado um pipeline de scripts para criar, testar e validar as alterações de código antes do merge na ramificação principal. Entrega e implantação contínuas (Continuous Delivery and Deployment - CD), consistem em um CI adicional, fazendo deploy do seu projeto em produção a cada push na ramificação padrão do repositório. Essas metodologias permitem detectar bugs e erros no início do ciclo de desenvolvimento, garantindo que todo o código implantado em produção esteja em conformidade com os padrões de código estabelecidos no projeto. O GitLab é uma plataforma completa de DevOps, que oferece soluções para CI/CD, e seus diversos benefícios podem ser consultados no seguinte link https://about.gitlab.com/is-it-any-good/#gitlab-ci-is-the-fastest-growing-cicd-solution. Tendo em vista a necessidade da implementação de CI neste projeto, seus benefícios, vasta documentação e a ferramenta ter sido mencionada na entrevista essa foi escolhida.
 
 ##### _14/06/2020_
 
 1. Implementação de Workflow básico
    1. Uma vez que as prioridades core já haviam sido alcançadas e extras seriam adicionados, de modo a não gerar confusão com o código já funcional, foi adicionado um workflow envolvendo: master, develop e branches. Vale salientar que esta decisão foi tomada de forma tardia e teria sido benéfico ter sido a primeira decisão no dia 13.
 2. Refatoração de código
    2. Refatoração é o processo de alterar um código de modo a não mudar seu comportamento externo e ainda melhorar sua estrutura interna. Este, é utilizado para manter um software bem projetado ao decorrer do tempo e as mudanças que ele sofre-rá. Este te como objetivo benefício manter simplicidade, clareza e ausência de repetição. Levando em consideração estes benefícios, foi decidido refatorar tanto os testes feitos inicialmente quanto a classe Dominio.php.
 3. Extensão do PHPUnit Runner
    3. Um ponto importante quando rodamos testes é visualizar de forma assertiva informações sobre os testes executados, como: nome, hora de inicio, duração do teste, mensagem retornada e status do mesmo. Tendo uma boa visualização em vista esta funcionalidade foi inserida.
 4. Priorização de execução em vez de novos recursos
    4. Foi necessário optar entre desenvolver novos recursos planejados e desenvolver um modo que garantisse plena execução da solução em ambiente de terceiros. Uma vez que o propósito é demonstrar o trabalho desenvolvido, optou-se por garantir que as soluções core solicitadas conseguiriam ser validades pela equipe da KingHost. 
 5. Docker image
    5. Considerando a necessidade de de rodar a solução implementada pela equipe da KingHost, foi desenvolvida uma imagem Docker que reproduz o mesmo sistema no qual a solução foi desenvolvida. Essa decisão foi tomada de modo a evitar possíveis divergências entre o corretor e o desenvolvedor da solução, como: SO, versão do SO, versão do PHP, versão do PHPUnit, versão do Composer e demais pacotes do SO necessários para instalar as dependências.
     
  
---
  ### _Seção 2: Implementações_
  
  Esta seção abordará como as implementações foram feitas e se necessário seus porquês não elucidados por se tratarem de questões de implementação. Além disso, é importante salientar que os tópicos serão abordados no seguinte formato:
  
  - Ferramenta Implementada.
    - Passo n.
        - (se necessário motivação/observações)
    - Passo n+1. 
        - (se necessário motivação/observações)
    
  ##### _Testes Unitários_
  
  1. Instalação PHP 7.4.
      1. Necessário PHP 7.3 ou PHP 7.4 para utilizar PHPUnit 9.
  2. Instalação Composer v1.10.7.
      2. Necessário para instalar PHPUnit 9.
      2. Necessário para instalação do Faker (https://github.com/fzaninotto/Faker).
  3. Estudo acerca do PHPUnit utilizando sua documentação (https://phpunit.readthedocs.io/pt_BR/latest/).
  4. Implementação dos testes.
  
  ##### _Pipeline CI_
  
  1. Estudo acerca de CI/CD.
  2. Estudo sobre como vincular GitHub e GitLab https://docs.gitlab.com/ee/user/project/import/github.html#import-your-project-from-github-to-gitlab.
  3. Vinculação deste repositório com GitLab.
  4. Estudo acerca de CI/CD no GitLab https://docs.gitlab.com/ee/ci/README.html.
  5. Implementação da CI
      5. Como pode ser visto nos commits ocorreram alguns erros nas tentativas de implementação devido a não familiaridade com CI e GitLab.
  
  ##### _Workflow_
  
  1. Criação da develop
  2. Proteção de merge da master e da develop, onde apenas é possível fazer merge se passou nos testes da pipeline.
  
  ##### _Refatoração_
  
  1. Refatoração da Dominio.php
      1. Tradução para o inglês. Motivação: O Inglês é o idioma internacional para código (e para documentações). Também, pois os comandos e palavras-chave de linguagens em programação são em inglês então a escrita em Português causa confusão.
      1. Mudança de nome de variáveis com base nas convenções https://www.php-fig.org/psr/.
      1. Reescrita de nomes de métodos. Motivação: Nem todos os nomes dos métodos eram auto-explicativos e indicavam de fato o que o método fazia. Esta modificação foi tomada com base no conteúdo lido no Clean Code acerca de nomes de métodos.
      1. Reescrita de comentários. Motivação: também com base no Clean Code, sabemos que um bom código frequentemente fala por si só e não carece comentários, principalmente quando são métodos tão simples como da classe Dominio.php. Tendo em vista que alguns comentários informavam para o que aquele método era utilizado e não o que ele fazia, optei por reescrever informando o que de fato o método fazia. Vale salientar, que o propósito dos métodos não se perdeu, os nomes dos testes exibem este. Não optei por apagar os comentários pois inseri blocos para PHPDoc na classe domínio.
  2. Criação de factory
  3. Refatoração dos testes utilizando os mesmos parâmetros da refatoração do Dominio.php.
        
             
   ##### _Extensão do PHPUnit Runner_
    
   1. Inicialmente tentei utilizar listeners, porém notei que estes estavam deprecados.
   2. Implementação da TestHooksHandler.php com base em https://phpunit.readthedocs.io/en/9.0/extending-phpunit.html#extending-the-testrunner.
    
   ##### _Docker image_
   
   1. Estudos acerca de como criar uma imagem Docker e fazer upload da mesma para o Docker Hub.
   2. Criação da imagem Docker.
   3. Testes da imagem Docker.
   4. Upload da imagem criada no Docker Hub.
   
   ##### _Planejado mas não implementado_ 
   
   1. PHPDocs
       1. Desafios com o Composer requerendo chave de acesso no GitHub não seriam resolvidos em tempo hábil para a data de entrega prevista. 
   2. Code coverage
       2. Desafios com a instalação do xdebug não seriam resolvidos em tempo hábil para a entrega prevista.   
   3. Code Quality (GitLab)
       3. Ferramenta estudada porém foi estimado que não seria possível implementar a tempo da entrega.
      
---
  ### _Seção 3: Execução da solução_
  
  Existem três possíveis execuções da solução. A primeira envolve instalar todas as dependências na máquina e lidar com eventuais desafios. A segunda envolve instalar o Docker e dar pull na imagem Docker desenvolvida. A terceira envolve solicitar acesso ao projeto no GitLab para ser inserido como colaborador e poder executar a pipeline.
  
  ##### _Solução 1: instalar dependências_ 
  
  
  1. Instale o PHP 7.4:
      1.  `sudo apt-get update`
      1.  `sudo apt-get install software-properties-common`
      1.  `sudo add-apt-repository ppa:ondrej/php`
      1.  `sudo apt-get update`
      1.  `sudo apt-get -y install php7.4`  
  2. Instale as dependências PHPUnit:
      2.  `sudo apt-get install php-xml`
      2.  `sudo apt-get install php7.4-mbstring`
  3. Instale o Composer 1.10.7 (Global):
      3.  `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
      3.  `php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"`
      3.  `php composer-setup.php`
      3.  `php -r "unlink('composer-setup.php');"`
      3.  `sudo mv composer.phar /usr/local/bin/composer`
  4. Clone este repositório.
  5. Entre na pasta clonada.
  6. Instale as dependências:  `composer install`
  7. Rode a solução com:  `./vendor/bin/phpunit`
  
  ##### _Solução 2: utilizar a imagem do Docker_ 
  
  1. Certifique-se que tenha o Docker instalado, se não o tiver instale-o.
  2. Faça pull da imagem:
      2.  `docker pull helenadufau/prova-qa`  
  3. Crie um container:
      3. `docker run --name ${nomeDoSeuContainer} -dit helenadufau/prova-qa`
  4. Acesse o container:
      4. `docker exec -it ${nomeDoSeuContainer} /bin/bash`
  5. Clone este repositório.
  6. Entre na pasta clonada.
  7. Instale as dependências:  `composer install`
  8. Rode a solução com:  `./vendor/bin/phpunit`
  
  ##### _Solução 3: rodar a pipeline no GitLab_ 
  
  1. Entre em contato com helenadufau@gmail.com e informe seu user no GitLab.
  2. Aguarde retorno e terá acesso concedido. Para acesso apenas de visualização do projeto:  https://gitlab.com/helenadufau/prova-qa-kinghost.