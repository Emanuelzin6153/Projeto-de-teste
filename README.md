🗺️ Mapa de Escritórios de Advocacia - Brasil
Sistema web completo para visualizar e gerenciar escritórios de advocacia em um mapa interativo do Brasil.

📋 Características
✅ Mapa Interativo - Mapa do Brasil com Leaflet.js e OpenStreetMap
✅ Cadastro de Escritórios - Adicione novos escritórios com localização exata
✅ Visualização em Tempo Real - Marcadores aparecem automaticamente no mapa
✅ Lista Lateral - Veja todos os escritórios cadastrados
✅ Busca por Localização - Encontre escritórios no mapa clicando nos marcadores
✅ Gerenciamento Completo - Adicione, visualize e delete escritórios
✅ Dados Persistentes - Todos os dados salvos em arquivo JSON
✅ Design Responsivo - Funciona em desktop, tablet e mobile

🛠️ Tecnologias Utilizadas
HTML5 - Estrutura da página
CSS3 - Estilização e design responsivo
JavaScript - Interatividade e requisições AJAX
PHP - Backend e gerenciamento de dados
Leaflet.js - Biblioteca de mapa interativo
OpenStreetMap - Tiles de mapa
JSON - Armazenamento de dados
📁 Arquivos do Projeto
mapa_advocacia.html    - Página principal (HTML + CSS + JavaScript)
api.php               - API PHP para gerenciar dados
escritorios.json      - Arquivo de armazenamento de dados (criado automaticamente)
🚀 Como Executar
Opção 1: Com PHP Built-in (Recomendado para Desenvolvimento)
cd /home/seu/diretorio
php -S localhost:8000
Depois abra no navegador: http://localhost:8000/mapa_advocacia.html

Opção 2: Com Apache/Nginx
Copie os arquivos para a pasta pública do servidor web e acesse via navegador.

📍 Como Usar
Adicionar um Escritório
Preencha os campos do formulário:

Nome do Escritório (obrigatório)
Endereço (obrigatório)
Cidade (obrigatório)
Estado - Sigla (SP, RJ, MG, etc) (obrigatório)
Latitude (obrigatório)
Longitude (obrigatório)
Telefone - adicionar antes se tiver
Especialidades - Áreas de atuação
Clique em "📍 Adicionar"

O marcador aparecerá automaticamente no mapa

Encontrar Coordenadas
Use o Google Maps ou OpenStreetMap:

Abra openstreetmap.org
Procure o endereço do escritório
Clique direito no local e copie as coordenadas (latitude, longitude)
Exemplos de Coordenadas no Brasil:
Cidade	Latitude	Longitude
São Paulo	-23.5505	-46.6333
Rio de Janeiro	-22.9068	-43.1729
Brasília	-15.8267	-47.8615
Salvador	-12.9714	-38.5014
Belo Horizonte	-19.9191	-43.9386
Curitiba	-25.4284	-49.2733
Porto Alegre	-30.0331	-51.2304
Visualizar Escritórios
No Mapa: Clique em qualquer marcador para ver informações do escritório
Na Lista: Veja todos os escritórios cadastrados na barra lateral direita
Deletar um Escritório
Clique no botão "🗑️ Deletar" ao lado do escritório na lista lateral

📊 Estrutura do JSON
Os dados são armazenados em escritorios.json:

[
  {
    "id": 1711700000000,
    "nome": "Silva & Associados",
    "endereco": "Av. Paulista, 1000",
    "cidade": "São Paulo",
    "estado": "SP",
    "latitude": -23.5505,
    "longitude": -46.6333,
    "telefone": "(11) 3000-0000",
    "especialidades": "Direito Trabalhista, Direito Civil",
    "data_adicao": "29/03/2026 10:30:45"
  }
]
🔒 Segurança
✅ Sanitização de todas as entradas
✅ Validação de dados no backend
✅ Prevenção de duplicatas
✅ Proteção contra XSS
✅ IDs únicos por timestamp
💡 Dicas
Use a barra de busca do navegador (com Ctrl+F) para procurar escritórios na lista
Zoom no mapa para ver escritórios em regiões específicas
Use as coordenadas negativas para Brasil (localizado no hemisfério sul)
Teste com alguns escritórios conhecidos antes de popultar com dados reais
🐛 Solução de Problemas
Arquivo tidak ada permissão para escrever
chmod 755 /home/seu/diretorio
Mapa não aparece
Verifique sua conexão com a internet (Leaflet precisa baixar tiles)
Limpe o cache do navegador
Dados não salvam
Verifique se o PHP está executando (use php -v)
Verifique permissões da pasta
📝 Exemplos de Uso
<!-- Para testar localmente, abra: -->
http://localhost:8000/mapa_advocacia.html

<!-- Para usar em produção, hospede em servidor com PHP habilitado -->
🎨 Personalização
Para mudar as cores, edite as variáveis CSS em mapa_advocacia.html:

/* Gradiente principal */
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);

/* Cor do botão */
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
📄 Licença
Livre para uso pessoal e comercial.

👨‍💻 Autor
Desenvolvido como sistema de gerenciamento de escritórios de advocacia.

Dúvidas? Consulte a documentação do Leaflet: leafletjs.com
