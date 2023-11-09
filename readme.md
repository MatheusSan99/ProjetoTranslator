# Projeto de Tradução Automática de Botões HTML

Este projeto tem como objetivo criar um sistema de padronização de tradução automática para os textos HTML em PHP, com base no padrão fornecido. O projeto usa o algoritmo k-Nearest Neighbors (k-NN) para determinar o padrão de tradução adequado para as descrições.

## Descrição do Projeto

O objetivo deste projeto é criar um sistema padronize automaticamente os textos em HTML para um formato padronizado. O padrão de tradução segue a estrutura das regras de negócio estabelecidas.

O algoritmo k-NN é usado para encontrar a tradução adequada com base nas descrições já existentes. Isso é útil para manter a consistência das traduções e economizar tempo na tradução manual.

## Como Funciona / Configuração

1. **Requisitos**:
   - PHP instalado em seu ambiente.

2. **Configuração**:
   - Clone o repositório para o seu ambiente local.

3. **Treinamento do Modelo**:
   - Colete um conjunto de dados de treinamento com descrições de botões existentes no banco de dados, incluindo os campos "nomeCampo" e "conteúdo".
   - Pré-processe as descrições para garantir que sigam um formato consistente.

4. **Aplicação do k-NN**:
   - Quando uma nova descrição de botão precisar ser traduzida, calcule a distância entre a nova descrição e as descrições existentes no conjunto de treinamento.
   - Selecione os k vizinhos mais próximos com base na distância calculada.
   - Com base nos k vizinhos mais próximos, determine o padrão de tradução mais comum ou a descrição do botão mais próxima e aplique-o ao novo valor.

## Contribuição

Sinta-se à vontade para contribuir com melhorias, correções ou novos recursos para este projeto. Basta criar um fork do repositório, fazer as alterações e enviar um pull request.

## Autor

- [Matheus Dos Santos](https://github.com/MatheusSan99) - Back End Developer

## Licença

Este projeto é licenciado sob a Licença MIT - consulte o arquivo [LICENSE](LICENSE) para obter detalhes.

--- 