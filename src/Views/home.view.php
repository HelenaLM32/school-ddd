<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School Management</title>

  <link rel="stylesheet" href="/css/style.css">
</head>

<body>

  <?php include 'parts/nav/nav.view.php' ?>

  <main class="container">
    <div class="header">
      <h1>School Management</h1>
      <p>Sistema de gestió escolar amb DDD aplicat en PHP</p>
    </div>

    <div class="grid">

      <div class="card">
        <h3>Alumnes</h3>
        <p>Gestiona els alumnes de l'escola.</p>
        <a href="/student/create" class="btn">Crear Alumne</a>
      </div>

      <div class="card">
        <h3>Professors</h3>
        <p>Gestiona els professors de l'escola.</p>
        <a href="/teacher/create" class="btn">Crear Professor</a>
      </div>

      <div class="card">
        <h3>Assignatures</h3>
        <p>Gestiona les assignatures del centre.</p>
        <a href="/subject/create" class="btn">Crear Assignatura</a>
      </div>

      <div class="card">
        <h3>Cursos</h3>
        <p>Gestiona els cursos de l'escola.</p>
        <a href="/course/create" class="btn">Crear Curs</a>
      </div>

      <div class="card">
        <h3>Matriculació</h3>
        <p>Matricula un alumne a una assignatura.</p>
        <a href="/enrollment/create" class="btn">Matricular</a>
      </div>

      <div class="card">
        <h3>Assignar Professor</h3>
        <p>Assigna un professor a una assignatura.</p>
        <a href="/subject/assign-teacher" class="btn">Assignar</a>
      </div>

    </div>
  </main>

  <?php include 'parts/footer/footer.view.php' ?>

</body>

</html>