
# API REST simples com PHP puro

Prova de conceito de uma API REST usando apenas PHP sem a adição de bibliotecas de terceiros

A API possui os seguintes recursos:

* Autoload, para os arquivos da API e classes personalizadas
* Controle de rotas, faz a chamada do metodo dentro da classe determinado na rota
* Padronização nas respostas, json ou arquivo
* Padronização na recepção dos dados enviados pelo usuario via: json, form-urlencoded, form-data, GET ou FILES

---

Exemplo da lista de rotas: ( index.php )
```php
  // GET /clientes, acessa a classe controllers/clientes.class.php no método index()
  $route->get('clientes', Clientes::class, 'index');
```

---

Os nomes dos parametros determinados na rota devem ter os mesmos nomes que os parametros solicitados no método da classe.

```php
  // index.php
  $route->put('clientes/{id}', Clientes::class, 'update');

  // controllers/clientes.class.php
  public function update( $id ) { ...
```

