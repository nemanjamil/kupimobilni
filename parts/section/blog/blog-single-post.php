<!-- ============================================== BLOG SINGLE POST ============================================== -->
<div class="blog-single-post wow fadeInUp" itemscope itemtype="http://schema.org/Article">

    <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage"
          itemid="<?php echo $NaslovVesti; ?>"/>

    <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <img class="img-responsive" src="<?php echo $velika_slikaVest; ?>" alt="pic"/>
        <meta itemprop="url" content="<?php echo DPROOT . $velika_slikaVest; ?>">
        <meta itemprop="width" content="100%">
        <meta itemprop="height" content="100%">
    </div>

    <h2 itemprop="headline "><?php echo $NaslovVesti; ?></h2>

    <span class="author-date hidden" itemprop="author" itemtype="https://schema.org/Person">
		<span itemprop="name"><?php echo 'By : ' . $imaPrevest; ?></span>
				<meta itemprop="datePublished" content="<?php echo $DatumVesti; ?>"/>
	</span>


    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <img class="hidden" src="<?php echo DPROOT . '/'.SLIKALOGO; ?>"/>
            <meta itemprop="url" content="<?php echo DPROOT . '/'.SLIKALOGO; ?>">
            <meta itemprop="width" content="50">
            <meta itemprop="height" content="50">
        </div>
        <meta itemprop="name" content="<?php echo $imaPrevest; ?>">
    </div>


    <meta itemprop="dateModified" content="<?php echo $DatumVesti; ?>"/>
    <div class="blog-content">
        <div class="last-para" itemprop="articleBody"><?php echo $VestiOpisVest; ?> </div>
    </div>
    <!-- /.blog-content -->
</div><!-- /.blog-single-post -->
<!-- ============================================== BLOG SINGLE POST : END ==============================================  -->