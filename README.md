<img alt="Dynamic element made with Vue in Wordpress theme" src="public/aliette-main.png"/>

# Creating single Vue components in WordPress theme without bundler

The purpose of this repository is to show how to add single Vue elements is WordPress theme. You don't need to use any bundler or to install any npm packets. Installing Vue using NPM is recommended for building larger Vue applications. In such cases, a build tool must be installed along with the NPM packages to handle the application's bundling. Bu

For smaller dynamic features, Vue.js can be added to a WordPress theme using a CDN installation.


<b>Table of contents</b>

- [1. Adding necessary scripts](#1-adding-necessary-scripts)
- [2. Dropdown element](#2-dropdown-element)
- [3. Slider element](#3-slider-element)
- [4. Tab element](#4-tab-element)



## 1. Adding necessary scripts

JavaScript scripts are added to WordPress with the wp_enqueue_script() function, meaning the CDN link is included in the wp_enqueue_script() function in the functions.php file

<b>funtions.php</b>

```
function essential_scripts() {

    wp_enqueue_script(
        'vue',
        'https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.39/vue.global.min.js',
        [],
        '3.2.39'
    );

    wp_enqueue_script(
        'dropdowns',
        get_template_directory_uri() . '/js/dropdowns.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'slider',
        get_template_directory_uri() . '/js/slider.js',
        ['vue'],
        '0.1.0',
        true
    );

    wp_enqueue_script(
        'tabs',
        get_template_directory_uri() . '/js/tabs.js',
        ['vue'],
        '0.1.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'essential_scripts');

```

## 2. Dropdown element

<b>dropdown.js</b>

```
(function () {

        const { createApp } = Vue

        createApp({
            data() {
                return {
                    isVisible: 'hidden',
                }
            },
            methods: {
                makeVisible() {
                    if (this.isVisible === 'hidden') {
                        this.isVisible = 'visible'
                    } else { this.isVisible = 'hidden' }
                }
            }
        }).mount('#my-first-dropdown')
})();

```

<b>dropdowns.js</b>

```
(function () {

    document.querySelectorAll('.menu-dropdown').forEach((element) => {
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    isVisible: 'hidden',
                }
            },
            methods: {
                makeVisible() {
                    if (this.isVisible === 'hidden') {
                        this.isVisible = 'visible'
                    } else { this.isVisible = 'hidden' }
                }
            }
        }).mount(element)
    })
})();

```

<b>archive-food_recipes.php, archive-drinks.php, taxonomy-course.php, taxonomy-drink_types.php, taxonomy-occasion_drinks.php, taxonomy-occasion.php, taxonomy-season.php</b>

```
<div class="menu-dropdown">
    <div class="dropdown">
        <button type="button" class="btn-category" v-on:click="makeVisible">
             <span>Select Category</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
        </button>
        <div class="food-dropdown-menu" :style="{ 'visibility': isVisible}">
            <?php 
                $taxonomies = get_object_taxonomies( 'food_recipes', 'objects' );

                foreach( $taxonomies as $taxonomy ){
                    echo $taxonomy->name;
                            
                    $terms = get_terms(array(
                        'taxonomy' => $taxonomy->name,
                        'hide_empty' => false,
                    ));
                            
                    foreach( $terms as $term ){
                        $term_link = get_term_link( $term );
                        echo "<a class='dropdown-item' href='{$term_link}'>{$term->name}</a>";
                    }
                }
            ?>
        </div>
    </div>
</div>

```

<img alt="Dropdown element made with Vue in Wordpress theme" src="public/dropdown-element.gif"/>


## 3. Slider element

<b>slider.js</b>

```
(function () {
    const { createApp } = Vue

    const MSlider = {
        data() {
            return {
                activeImage: 0,
                totalImages: 0,
            }
        },
        methods: {
            setTotalImages(images) {
                this.totalImages = images;
            },
            nextSlide() { 
                if (this.activeImage >= this.totalImages - 1) 
                    { this.activeImage = 0; return; 

                    } 
                    this.activeImage++;
            },
            prevSlide() { 
                if (this.activeImage == 0) 
                    { this.activeImage = this.totalImages - 1; 
                        return; 
                    } 
                this.activeImage--; 
            }, 
            setActiveImage(number) { 
                this.activeImage = number; 
            }
        },
        mounted() {
            setInterval(() => {
                if (this.activeImage >= this.totalImages - 1) {
                    this.activeImage = 0;
                    return;
                }
                this.activeImage++;
            }, 5000);
        },

    }

    createApp(MSlider).mount('#slider')
})();
```

<b>page-about.php</b>

```
<div id="slider"> 
    <div class="carousel slide"> 
        <!-- Indicators --> 
        <ul class="carousel-indicators">
            <li :class="{'active': activeImage == 0}" v-on:click="setActiveImage(0)"></li> 
            <li :class="{'active': activeImage == 1}" v-on:click="setActiveImage(1)"></li> 
            <li :class="{'active': activeImage == 2}" v-on:click="setActiveImage(2)"></li> 
        </ul> 
        <div v-bind="setTotalImages(<?php echo count(get_field('slider_images'));?>)"> 
            <?php 
                $slider = get_field('slider_images'); 
                $index = 0; 
                for($i = 0; $i < count($slider); $i++) { ?> 
                    <figure v-show="activeImage == <?php echo $index++; ?>" class="slide">
                        <img src="<?php echo $slider['image_slide_' . $i+1]['image_'. $i+1]; ?>" alt="" class="sliderImage">
                        <h3 class="slide-text"><?php echo $slider['image_slide_' . $i+1]['image_'. $i+1 . '_text']; ?></h3> 
                    </figure> 
            <?php } ?> 
        </div> 
        <div class="carousel-control-prev">
            <div class="carousel-control-button-prev" v-on:click="prevSlide"> 
                <span class="carousel-control-prev-icon"></span> 
            </div> 
        </div> 
        <div class="carousel-control-next"> 
            <div class="carousel-control-button-next" v-on:click="nextSlide"> 
                <span class="carousel-control-next-icon"></span> 
            </div> 
        </div> 
    </div> 
</div>
```

<img alt="Slider element made with Vue in Wordpress theme" src="public/slider-element.gif"/>


## 4. Tab element

<b>tabs.js</b>

```
(function() {
        const MTabs = {
            data() {
                return {
                    tabIndex: 1,
                }
            },
        };

        const app = Vue.createApp(MTabs);
        app.mount('#tab-component');
})();
```

<b>single-food_recipes</b>

```
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
```

<img alt="Tab element made with Vue in Wordpress theme" src="public/tab-element.gif"/>



