<html>
<head>

   <style>
   .pos{
    position:absolute;
    top:10px;
    left:300px;
    }

    a{
     text-decoration:none;
     color:#fff;
     }
</style>

<title>Sistema Escolar</title>

</head>

<body bgcolor="#585858"> -- fundo Cinza
<table border="1" class="pos">

      <tr >
	    <td width=800px height="300px" bgcolor="#BDBDBD">
		<center><img src="cadastro.png" ></center>
	  </td>
    </tr>
   
	 <-- Título do menu -->
	<tr>
	<td bgcolor="#000">
		<p align=center><font color="#fff">Menu Principal</p>
	</td>
   </tr>

   <-- SEÇÃO: Cadastros -->   
   <tr>
	<td bgcolor="#4a4a4a">
		<p align="center"><font color="#fff">Cadastros</font></p>
    </td> 
   <tr>
	
   <tr>
     <td><p align="center"><a href="cadalunos.html">Alunos</a></p></td>
	</tr>
	
	<tr>
     <td><p align="center"><a href="cadcurso.html">Cursos</a></p></td>
	</tr>

	<tr>
     <td><p align="center"><a href="caddisciplina.html">Disciplina</a></p></td>
	</tr>


	<!-- SEÇÃO: Pesquisar -->
	<tr>
	  <td bgcolor="#4a4a4a">
		<p align="center"><font color="#fff">Pesquisar</font></p>
	</td>
   </tr>

   <<tr>
	  <td>
		<p align=center>
			<a href="Pesquisageral.php">Alunos - Lista Geral</a>
		</p>
	  </td>
	</tr>

    <tr>
	  <td>
		<p align=center>
			<a href="consulta_aluno.html">Alunos - Pesquisa por Nome</a>
		</p>
	  </td>
	</tr>
	
	<tr>
	   <td>
		<p align=center>
			<a href="geralcurso.php"><font color="cyan">Curso- Lista Geral</a></font>
		</p>
	   </td>
	</tr>
	
	<tr>
	   <td>
			<p align=center>
				<a href="consulta_curso.html"><font color="cyan">Cursos- Pesquisa Por Nome</font></a>
			</p>
		</td>
	</tr>

	<tr>
	   <td>
		    <p align=center>
			    <a href="geraldisciplina.php"><font color="cyan">Disciplinas- Lista Geral</font></a>
			</p>
		</td>
	</tr>
	
	<tr>
		<td>
			<p align=center>
				<a href="consulta_disciplina.html"><font color="cyan">Disciplinas Pesquisa Por Nome</font></a>
			</p>
		</td>
	</tr>

</table>

</body>
</html>