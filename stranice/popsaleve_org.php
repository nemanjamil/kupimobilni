<div class="config-options">
    <h4>Pages</h4>
    <ul class="list-unstyled animate-dropdown">
        <li class="dropdown">
            <button class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown">View Pages</button>
            <ul class="dropdown-menu" role="menu">
                <li role="presentation" class="dropdown-header">Home Pages</li>
                <li><a href="index.php?page=fashion-v1">Fashion V1</a></li>
                <li><a href="index.php?page=fashion-v2">Fashion V2</a></li>
                <li><a href="index.php?page=fashion-v3">Fashion V3</a></li>
                <li><a href="index.php?page=fashion-v4">Fashion V4</a></li>
                <li><a href="index.php?page=fashion-v5">Fashion V5</a></li>
                <li><a href="index.php?page=fashion-v6">Fashion V6</a></li>
                <li class="divider"></li>
                <li role="presentation" class="dropdown-header">Other Pages</li>
                <li><a href="index.php?page=blog">Blog</a></li>
                <li><a href="index.php?page=blog-single">Blog Single</a></li>
                <li><a href="index.php?page=box">Box</a></li>
                <li><a href="index.php?page=cart">Cart</a></li>
                <li><a href="index.php?page=category-v1">Category V1</a></li>
                <li><a href="index.php?page=category-v2">Category V2</a></li>
                <li><a href="index.php?page=category-v3">Category-V3</a></li>
                <li><a href="index.php?page=checkout">Checkout</a></li>
                <li><a href="index.php?page=contact-us">Contact Us</a></li>
                <li><a href="index.php?page=details-v1">Details V1</a></li>
                <li><a href="index.php?page=details-v2">Detail V2</a></li>
                <li><a href="index.php?page=digital">Digital</a></li>
                <li><a href="index.php?page=food">Food</a></li>
                <li><a href="index.php?page=footers">Footers</a></li>
                <li><a href="index.php?page=furniture">Furniture</a></li>
                <li><a href="index.php?page=handtools">Handtools</a></li>
                <li><a href="index.php?page=headers">Headers</a></li>
            </ul>
        </li>
    </ul>
    <h4>Header Styles</h4>

    <ul class="list-unstyled animate-dropdown">
        <li class="dropdown">
            <button class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown">View styles</button>
            <ul class="dropdown-menu" role="menu">
                <li role="presentation" class="dropdown-header">Header Styles</li>
                <?php
                parse_str($_SERVER['QUERY_STRING'], $query);
                for ($i = 1; $i <= 8; $i++) {
                    $query['h'] = $i;
                    echo '<li><a href="index.php?' . http_build_query($query, '', '&amp;') . '"> Header <sup>v' . $i . '</sup></a></li>';
                }
                ?>
            </ul>
        </li>
    </ul>

    <h4>Footer Styles</h4>

    <ul class="list-unstyled animate-dropdown">
        <li class="dropdown">
            <button class="dropdown-toggle btn btn-primary btn-block" data-toggle="dropdown">View styles</button>
            <ul class="dropdown-menu" role="menu">
                <li role="presentation" class="dropdown-header">Footer Styles</li>
                <?php
                parse_str($_SERVER['QUERY_STRING'], $query);
                for ($i = 1; $i <= 5; $i++) {
                    $query['f'] = $i;
                    echo '<li><a href="index.php?' . http_build_query($query, '', '&amp;') . '"> Footer <sup>v' . $i . '</sup></a></li>';
                }
                ?>
            </ul>
        </li>
    </ul>

    <h4>Layouts</h4>
    <ul class="list-unstyled">
        <li><a href="index.php?page=fashion-v6">Full Width</a></li>
        <li><a href="index.php?page=box">Boxed</a></li>
    </ul>
    <h4>Colors</h4>
    <ul class="list-unstyled">
        <li><a class="changecolor green-text" href="#" title="Green color">Green</a></li>
        <li><a class="changecolor red-text" href="#" title="Red color">Red</a></li>
        <li><a class="changecolor light-green" href="#" title="Light Green color">Light Green</a></li>
        <li><a class="changecolor orange" href="#" title="Orange color">Orange</a></li>
        <li><a class="changecolor violet" href="#" title="Violet color">Violet</a></li>
        <li><a class="changecolor blue" href="#" title="Blue color">Blue</a></li>
    </ul>
</div>