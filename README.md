
# API REST simples com PHP puro

Prova de conceito de uma API REST usando apenas PHP sem a adição de bibliotecas de terceiros

---

Exemplo da lista de rotas: ( index.php )
```php
  // GET /clientes, acessa a classe classes/clientes.class.php no método index()
  $rota->get('/clientes', 'Clientes::index');
```

---

Os nomes dos parametros determinados na rota devem ter os mesmos nomes que os parametros solicitados no método da classe.

```php
  // index.php
  $rota->put('/clientes/{id}', 'Clientes::update');

  // classes/clientes.class.php
  public function update( $id ) { ...
```

