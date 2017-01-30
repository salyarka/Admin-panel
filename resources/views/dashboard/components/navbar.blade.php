<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        @if (Auth::user()->role == 'superAdmin')
          <li><a href="{{ url('/admin')}}">Администраторы</a></li>
        @endif
        <li><a href="{{ url('/admin/faq')}}">Темы</a></li>
        <li><a href="{{ url('/admin/faq/unanswered')}}">Вопросы без ответов</a></li>
        <li><a href="{{ url('/admin/blocked')}}">Заблокированные вопросы</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('/logout')}}"><span class="glyphicon glyphicon-log-in"></span> Выход</a></li>
      </ul>
    </div>
  </div>
</nav>
