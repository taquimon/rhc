<div style="height:50px; width:100%; border:0px solid #000;" class="ui-widget">
    <div class="app-bar">
        <a class="app-bar-element branding" href="<?=base_url().'home'?>"><span id="toggle-tiles-dropdown2" class="mif-apps mif-2x fg-amber"></span> Inicio</a>

        <ul class="app-bar-menu">
            <li><a href="<?=base_url().'player'?>"><span class="mif-users fg-amber"></span> Jugadores</a>
            </li>
            <li>
                <a href="" class="dropdown-toggle">Clubes</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="<?=base_url().'club'?>">Lista</a>
                    </li>
                    <li><a href="<?=base_url().'club'?>">Delegados</a>
                    </li>
                </ul>
            </li>
            <li><a href="<?=base_url().'partido/ranking'?>"><span class="mif-list-numbered fg-amber"></span> Ranking</a>
            </li>
            <li><a href="<?=base_url().'partido'?>"><span class="mif-calendar fg-amber"></span> Partidos</a>
            </li>
        </ul>
        <span class="app-bar-pull"></span>
    </div>
</div>