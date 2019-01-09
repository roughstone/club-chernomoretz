<nav>
<ul>
	<li class='menu' onClick='$(".nav_btn").fadeToggle(100); $(".dropdownContent").fadeOut(100);'><a><div><img src="images/menu_icon.jpg"></div></a></li>
	<li class="nav_btn"><a href = 'index.php'>Начало</a></li>
	<li class="nav_btn"><a href = 'index.php?новини' id='news'>Новини</a></li>
	<li class="nav_btn"><a href = 'index.php?треньори' id='trainers'>Треньори</a></li>
	<li class="nav_btn"><a href = 'index.php?състезатели' id='competitors'>Състезатели</a></li>
	<li class="nav_btn"><a href = 'index.php?график'>График</a></li>
	<li class='dropdownSource nav_btn'><a href ='javascript:void(0)' class='dropdownSourceButton' onclick=document.getElementById('dropdownContentg').style.display='block'>Галерия</a>
    <div class="dropdownContent" id="dropdownContentg">
        <a href = 'index.php?галерии=Състезания'>Състезания</a>
        <a href = 'index.php?галерии=Тренировки'>Тренировки</a>
		<a href = 'index.php?галерии=Събития'>Събития</a>
		<a href = 'index.php?Видео'>Видео</a>
	</div></li>
<li class='contacts nav_btn' onClick='$(".contacts_container").fadeIn(400);'><a><div>Контакти с нас!</div></a></li>
 </ul>
</nav>