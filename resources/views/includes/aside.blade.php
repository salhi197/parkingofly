<aside class="left-sidebar" data-sidebarbg="skin6" >
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @auth('admin')



                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="{{route('home')}}" aria-expanded="false">
                            <i class="fas fa-calendar"></i>
                                <span class="hide-menu">Tableau de bord</span>
                            </a>
                        </li>
                        

                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="{{route('reservation.index')}}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                                <span class="hide-menu">Reservations</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="/hotel" aria-expanded="false">
                            <i class="fas fa-users"></i>
                                <span class="hide-menu">Hotels</span>
                            </a>
                        </li>

                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="{{route('reservation.caisse')}}" aria-expanded="false">
                            <i class="fa fa-list"></i>
                                <span class="hide-menu">Caisse</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="/place " aria-expanded="false">
                            <i class="fas fa-list"></i>
                                <span class="hide-menu">Les Places</span>
                            </a>
                        </li>


                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="/setting" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                                <span class="hide-menu">Param??tres</span>
                            </a>
                        </li>

                        

                        <li class="sidebar-item"> <a 
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                            class="sidebar-link" href="{{ route('logout') }}"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">D??connexion
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </span></a>
                        </li>
                        @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
