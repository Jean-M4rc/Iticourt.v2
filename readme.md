# Iticourt

## L'itinéraire des circuits courts

Présentation du projet :
Ce site a pour objectif de donner à l'utilisateur un itinéraire routier vers un producteur qui effectue de la vente directe.
Cela permet de promouvoir les circuits courts et d'améliorer l'économie agricole.
Ce site est mobile-first et s'inscrit dans une démarche PWA (Progressive Web App).
La partie back-end sera réalisée par le framework Laravel 5.6, le front-end sera mis en place avec le framework Vue.js et la carte sera issue de la librairie Leaflet.

## Le Cahier des charges / Specs

* L'utilisateur doit pouvoir créer un compte et s'enregistrer
* L'utilisateur doit pouvoir enregistrer ses points de vente favoris et y accéder dans son espace personnel (pas d'adresse fixe car elle se met à jour à la connexion/au rafraichissement)
* Le vendeur doit pouvoir créer son point de vente en ajoutant ses coordonnées GPS et le type de produits vendus
* Le vendeur doit pouvoir entrer un texte de présentation et une photo (ou plusieurs) permettant d'identifier son point de vente et ses produits
* Un seul photo du vendeur sera visible dans l'infobox sur la carte, les autres photos seront visibles sur la page du vendeur
* L'utilisateur doit pouvoir noté et commentez le vendeur, le vendeur doit pouvoir répondre aux commentaires le concernant
* L'utilisateur doit voir apparaitre un itinéraire routier lorsqu'il choisi un point de vente, l'itinéraire routier doit rester simple et proposer le trajet le plus court jusqu'au point de vente
* L'itinéraire doit se mettre à jour au clique sur un bouton ou toutes les minutes avec une requête mobile
* L'itinéraire doit etre imprimable
* Envoi de mail pour valider les adresses mails, en cas de nouveau follower et en cas de nouveau commentaire

## Technos utilisées

* Laravel 5.6
* Vue.js 2.5.16  -- Vuejs abandonné car trop difficile à mettre en place. Reprise du code JavaScript avec jQuery.
* Leaflet 1.3.4