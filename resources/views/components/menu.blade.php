<aside class="left-menu">
    <nav>
        <div class="menu">
            <div class="menu-icon-list">
                <i class="bi bi-list"></i>
            </div>
            <div class="menu-open menu-tittle">
                <i class="bi bi-book-half"></i>
                <b>BOOKS</b>
                <i class="bi bi-arrow-left-circle" id="menu-close"></i>
            </div>
        </div>
        <a href="/" class="menu-icon-calculator" id="pos">
            <i class="bi bi-calculator"></i>
            <span class="menu-text">POS</span>
        </a>
        <a href="/stocks/" class="menu-icon-boxes" id="stocks">
            <i class="bi bi-boxes"></i>
            <span class="menu-text">Stocks</span>
        </a>
    </nav>
</aside>

<script>
    $('.menu-icon-list').hide()
    
    $('#menu-close').on('click' , function(){
        $('.menu-text').hide( 1000 );
        $('.menu-icon-list').show( 1000);
        $('.menu-tittle').hide( 1000 );
    })
    
    $('.menu-icon-list').on('click' , function(){
        $('.menu-icon-list').hide( 1000 ) ;
        $('.menu-text').show( 1000 );
        $('.menu-tittle').show(1000 );
    })
</script>