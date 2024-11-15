<?php get_header(); ?>
<div class="container single-page-margin-bottom">
    <h2 class="header-margins single-title"><?php the_title(); ?></h2>
    <p class="single-intro-text"><?php the_field('intro_text'); ?></p>
    <img class="img-fluid single-recipe-image" src="<?php echo the_post_thumbnail_url(); ?>">
    <hr class="single-line">
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-9">
            <h3 style="margin-bottom: 30px;"><?php the_title(); ?></h3>
            <div class="recipe-info">
                <p class="heading-text text-margin-bottom">Cooking time:&nbsp;</p>
                <p class="text-margin-bottom"><?php the_field('cooking_time'); ?></p>
            </div>
            <div class="recipe-info">
                <p class="heading-text text-margin-bottom">Servings:&nbsp;</p>
                <p class="text-margin-bottom"><?php the_field('servings'); ?></p>
            </div>
        </div>
        <?php
            $intro_text = get_field('intro_text');
        ?>
    </div>
    <?php 
        $inc_string = get_field('ingredients');
        $inc_table = explode("\n", $inc_string);
        $instruction_string = get_field('instructions');
        $instruction_table = preg_split("/Step/", $instruction_string, -1, PREG_SPLIT_NO_EMPTY);
    ?>
    <div class="mt-5" id="tab-component">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item" :class="{'active': tabIndex == 1}">
                <a class="nav-link" href="#tab-1" v-on:click.prevent="tabIndex = 1">Ingredients</a>
            </li>
            <li class="nav-item" :class="{'active': tabIndex == 2}">
                <a class="nav-link" href="#tab-2" v-on:click.prevent="tabIndex = 2">Instructions</a>
            </li>
            <li class="nav-item" :class="{'active': tabIndex == 3}">
                <a class="nav-link" href="#tab-3" v-on:click.prevent="tabIndex = 3">Nutrition Facts</a>
            </li>
        </ul>
        <div class="tab-table">
            <div v-show="tabIndex == 1" id="tab-1">
                <h4 class="tab-title">Ingredients</h4>
                <ul>
                    <?php 
                        foreach ($inc_table as $item) {                                                    
                    ?>
                    <li>
                        <!-- <i class="fa fa-square-o fa-lg ingredient-list-icon" aria-hidden="true"></i>
                            <i class="fa fa-check-square-o fa-lg ingredient-list-icon" aria-hidden="true"></i> -->
                        <?php echo $item;?>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div v-show="tabIndex == 2" id="tab-2">
                <h4 class="tab-title">Instructions</h4>
                <ul class="list-no-style">
                    <?php 
                        foreach ($instruction_table as $index => $value) {                                                    
                    ?>
                    <li class="instruction-step">
                        <div class="instruction-text">Step <?php echo $value;?></div>
                    </li>
                    <!-- <li v-bind="setIncitable(<-?php echo $key; ?>, false)">
                            <i class="fa fa-square-o fa-lg ingredient-list-icon" v-on:click.prevent="setCheckstat(<-?php echo $key; ?>, true)" aria-hidden="true"></i>
                            <i class="fa fa-check-square-o fa-lg ingredient-list-icon" v-show="inciTable[<-?php echo $key; ?>].status == true" v-on:click.prevent="setCheckstat(<-?php echo $key; ?>, false)" aria-hidden="true"></i>
                        </li> -->
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div v-show="tabIndex == 3" id="tab-3">
                <h4>Nutrition Facts</h4>
                <p class="tab-title">per serving</p>
                <?php
                    $nutrition_facts = get_field('nutrition_facts');
                ?>
                <div class="row" style="margin-top: 96px;">
                    <div class="col-md-3 col-sm-3">
                        <p class="text-margin-bottom"><b><?php echo $nutrition_facts['calories']; ?></b></p>
                        <p class="text-margin-bottom">Calories</p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <p class="text-margin-bottom"><b><?php echo $nutrition_facts['fat']; ?>g</b></p>
                        <p class="text-margin-bottom">Fat</p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <p class="text-margin-bottom"><b><?php echo $nutrition_facts['carbs']; ?>g</b></p>
                        <p class="text-margin-bottom">Carbs</p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <p class="text-margin-bottom"><b><?php echo $nutrition_facts['protein']; ?>g</b></p>
                        <p class="text-margin-bottom">Protein</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?php get_footer(); ?>