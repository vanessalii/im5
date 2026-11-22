<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Konfiguration der verschiedenen Module
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> example
            ->add_fields('example', 'Beispiel', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('image', 'image', 'Bild')->set_required(),
            ])

            //hero_front 
            ->add_fields('hero_front', 'Hero Startseite', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('text', 'name', 'Name'), 
                Field::make('textarea', 'subline', 'Subline'),
                Field::make('image', 'image', 'Bild')->set_required(),
                
            ])

            //->overview_projects
            ->add_fields('overview_projects', 'Übersicht Projekte', [
                Field::make('text', 'title_main', 'Titel Weiss')->set_required(),
                Field::make('text', 'title_accent', 'Titel Türkis'),
                Field::make('association', 'selection', 'Auswahl Projekte')
                    ->set_types([
                        [
                            'type'      => 'post',
                            'post_type' => 'project',
                        ]
                    ])                
                ])


            // -> about_me
            
            ->add_fields('about_me', 'Über mich', [
                Field::make('text', 'title_accent', 'Titel Türkis')->set_required(),
                Field::make('text', 'title_main', 'Titel Weiss'),
                Field::make('textarea', 'description', 'Beschreibung'),
                Field::make('image', 'image', 'Bild'),
            ])

            // -> Rechtlicher Text
            ->add_fields('legal', 'Rechtlicher Text', [
                Field::make('rich_text', 'legal_content', 'Text'),
            ])

            // todo: add new modules here
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);


           

            // -> Module für einzelne Projekte
            Container::make('post_meta', 'Projektmodule')
                ->where('post_type', '=', 'project')
                ->add_fields([
                    Field::make('complex', 'project_modules', 'Projektmodule')

                        // -> Bildergalerie
                        ->add_fields('gallery', 'Bildergalerie', [
                            Field::make('media_gallery', 'images', 'Bilder')
                                ->set_type('image'),
                        ])

                        // -> Bilder untereinander
                        ->add_fields('image_stack', 'Bilder untereinander', [
                            Field::make('media_gallery', 'images', 'Bilder')
                                ->set_type('image'),
                        ])

                        ->set_layout('tabbed-vertical')
                ]);

                




// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            
            case 'example':
                $module['image'] = get_media_by_id($module['image'], 'full');
                    break;

            case 'hero_front':
            $module['image'] = get_media_by_id($module['image']);
                    break;

            case 'overview_projects':
                $module['selection'] = array_map(function($item) {
                    return (int)$item['id'];
                }, $module['selection']);
                    break;
            
            case 'about_me':
                $module['image'] = !empty($module['image'])
                    ? get_media_by_id($module['image'])
                    : null;
                break;


                // todo: add data modifications for modules here as a new case
       
                }


        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );
    }
}


function render_project_modules(): void {
    $modules = carbon_get_the_post_meta('project_modules');

    if (empty($modules)) {
        return;
    }

    foreach ($modules as $module) {

        switch ($module['_type']) {

            
        case 'gallery':
            $images = [];

            foreach ($module['images'] as $image_id) {
                $image = get_media_by_id($image_id);

                if (!empty($image['src'])) {
                    $image['title'] = get_the_title($image_id);
                    $image['year'] = wp_get_attachment_caption($image_id);

                    $images[] = $image;
                }
            }

            $module['images'] = $images;
            break;

                        // -> Bilder untereinander
            case 'image_stack':
                $images = [];

                foreach ($module['images'] as $image_id) {
                    $image = get_media_by_id($image_id, 'full');

                    if (!empty($image['src'])) {
                        $images[] = $image;
                    }
                }

                $module['images'] = $images;
                break;


            default:
                continue 2;
        }

        get_template_part(
            'frontend/views/modules/project_' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );
    }
}
