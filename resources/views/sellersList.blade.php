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
            <a class="nav-link" id="cat2-tab" data-toggle="tab" href="#cat2" role="tab" aria-controls="cat2" aria-selected="false">Viandes & Oeufs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat3-tab" data-toggle="tab" href="#cat3" role="tab" aria-controls="cat3" aria-selected="false">Laits & Fromages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cat4-tab" data-toggle="tab" href="#cat4" role="tab" aria-controls="cat4" aria-selected="false">Boissons & Alcools</a>
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

    </div>

</div>
@endsection