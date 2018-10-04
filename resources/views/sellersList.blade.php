@extends('layout') 
@section('contenu')

<h1 class="text-center my-4">Voici l'ensemble des points de vente d'iticourt</h1>
<p class="lead text-center">Chaque point de vente est classé dans sa catégorie</p>
<hr class="my-4">

<div class="container">

    <!-- Nav rootTabs -->
    <ul class="nav nav-tabs" id="sellerListTabTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cat1-tab" data-toggle="tab" href="#cat1" role="tab" aria-controls="cat1" aria-selected="true">Fruits & Légumes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat2-tab" data-toggle="tab" href="#cat2" role="tab" aria-controls="cat2" aria-selected="false">Volailles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat3-tab" data-toggle="tab" href="#cat3" role="tab" aria-controls="cat3" aria-selected="false">Oeufs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat4-tab" data-toggle="tab" href="#cat4" role="tab" aria-controls="cat4" aria-selected="false">Laits & Fromages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat5-tab" data-toggle="tab" href="#cat5" role="tab" aria-controls="cat5" aria-selected="false">Charcuterie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat6-tab" data-toggle="tab" href="#cat6" role="tab" aria-controls="cat6" aria-selected="false">Boucherie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat7-tab" data-toggle="tab" href="#cat7" role="tab" aria-controls="cat7" aria-selected="false">Textiles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat8-tab" data-toggle="tab" href="#cat8" role="tab" aria-controls="cat8" aria-selected="false">Autres</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <!-- cat1 tab -->
        <div class="tab-pane active" id="cat1" role="tabpanel" aria-labelledby="cat1-tab">

            @include('partials.cat.nav_tab')

            @include('partials.cat.cat1_tab')

                </tbody>
            </table>

        </div>

        <!-- cat2 tab -->
        <div class="tab-pane" id="cat2" role="tabpanel" aria-labelledby="cat2-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat2_tab')
                </tbody>
            </table>

        </div>

        <!-- cat3 tab -->
        <div class="tab-pane" id="cat3" role="tabpanel" aria-labelledby="cat3-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat3_tab')
                </tbody>
            </table>

        </div>

        <!-- cat4 tab -->
        <div class="tab-pane" id="cat4" role="tabpanel" aria-labelledby="cat4-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat4_tab')
                </tbody>
            </table>

        </div>

        <!-- cat5 tab -->
        <div class="tab-pane" id="cat5" role="tabpanel" aria-labelledby="cat5-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat5_tab')
                </tbody>
            </table>

        </div>

        <!-- cat6 tab -->
        <div class="tab-pane" id="cat6" role="tabpanel" aria-labelledby="cat6-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat6_tab')
                </tbody>
            </table>

        </div>

        <!-- cat7 tab -->
        <div class="tab-pane" id="cat7" role="tabpanel" aria-labelledby="cat7-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat7_tab')
                </tbody>
            </table>

        </div>

        <!-- cat8 tab -->
        <div class="tab-pane" id="cat8" role="tabpanel" aria-labelledby="cat8-tab">

            @include('partials.cat.nav_tab')
            @include('partials.cat.cat8_tab')
                </tbody>
            </table>

        </div>

    </div>

</div>
@endsection