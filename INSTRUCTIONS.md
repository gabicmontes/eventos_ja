<h1>EventosJá</h1>
<p>Sistema de gerenciamento de eventos</p>
<br>
<p>Para instalar o projeto, siga as seguintes instruções:</p>
<p>1. Copiar repositório:<br>
Vá até a pasta que deseja instalar o projeto e digite:<br>
<b>git init</b><br>
<b>git clone https://github.com/gabicmontes/eventos_ja.git</b>
</p>
<p>2. Instalar composer:<br>
<b>composer install</b>
</p>

<p>3. Gerar arquivo .env:</p>
<b>cp .env.example .env</b></br>
</p>

<p>4. Gerar chave:<br>
<b>php artisan key:generate</b></br>
</p>

<p>5. Configurar banco de dados<br>
Vá até o arquivo <b>.env</b>e configure o seguinte paragrafo referente a conexão com seu banco de dados<br>
<b>DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=name_bd<br>
DB_USERNAME=root<br>
DB_PASSWORD=</b>
</p>
<p>
<h3>PRONTO!</h3>
Agora é só rodar o <b>php artisan serve</b>, inserir seus eventos e usar o sistema.
</p>
