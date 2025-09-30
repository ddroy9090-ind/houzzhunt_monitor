<?php
declare(strict_types=1);

return [
    'breez-by-danube' => [
        'id' => 0,
        'project_name' => 'Breez by Danube',
        'property_name' => 'Breez by Danube',
        'property_title' => 'Unparalleled Seafront Luxury Living in Dubai Maritime City',
        'property_location' => 'Dubai Maritime City, UAE',
        'project_status' => 'New Launch',
        'property_type' => 'Apartment',
        'starting_price' => '1.3M',
        'bedroom' => '5',
        'bathroom' => '4',
        'parking' => '2',
        'total_area' => '2,100 sq ft',
        'completion_date' => 'Q1 2029',
        'hero_banner' => 'assets/images/offplan/breez-by-danube.webp',
        'gallery_images' => json_encode([
            'assets/images/offplan/breez-by-danube.webp',
            'assets/images/offplan/1.webp',
            'assets/images/offplan/2.webp',
            'assets/images/offplan/3.webp',
            'assets/images/offplan/4.webp',
        ], JSON_UNESCAPED_SLASHES),
        'amenities' => json_encode([
            'Cinema',
            'Club',
            'Spa & Sauna',
            'Gym',
            'Hammock BBQ',
            'Kids Daycare',
            'Kids Splash Pool',
            'Pool',
            'Swing',
            'View Deck',
        ], JSON_UNESCAPED_SLASHES),
        'about_project' => '<p>Discover Danube Breez, where seafront elegance meets the dynamic energy of Dubai Maritime City. Every element is designed to offer comfort, sophistication and effortless living, from panoramic ocean views to a location that keeps the city’s vibrant opportunities within easy reach.</p>'
            . '<p>Homes at Breez range from chic studios to expansive four-bedroom villas, each thoughtfully designed to maximise space, natural light and comfort. Large windows frame breathtaking vistas, while smart layouts ensure every corner of your home is functional and inviting.</p>'
            . '<p>With over 40 resort-style amenities including an infinity pool, outdoor cinema and mini-golf, Breez offers a seamless path to luxury living. It is a permanent vacation and a smart investment in a life of ease and indulgence.</p>',
        'floor_plans' => json_encode([
            [
                'title' => 'Studio',
                'area' => '1,600 sq ft',
                'price' => '',
                'file' => 'assets/images/offplan/studio.png',
            ],
            [
                'title' => '1 Bedroom',
                'area' => '1,450 sq ft',
                'price' => '',
                'file' => 'assets/images/offplan/1-br.png',
            ],
            [
                'title' => '2 Bedroom',
                'area' => '2,800 sq ft',
                'price' => '',
                'file' => 'assets/images/offplan/2-br.png',
            ],
            [
                'title' => '3 Bedroom',
                'area' => '3,600 sq ft',
                'price' => '',
                'file' => 'assets/images/offplan/3-br.png',
            ],
        ], JSON_UNESCAPED_SLASHES),
        'developer_name' => 'Danube Properties',
        'developer_established' => '1993',
        'completed_projects' => '20+',
        'international_awards' => '10+',
        'on_time_delivery' => '95%',
        'about_developer' => 'Danube Properties is one of the Middle East’s most trusted developers, known for delivering high-quality communities that balance lifestyle and investment value. With a strong portfolio of residential projects across Dubai, Danube combines smart design with accessible payment plans to help residents and investors achieve long-term growth.',
        'meta_title' => 'Breez by Danube | Luxury Seafront Residences in Dubai Maritime City',
        'meta_description' => 'Explore Breez by Danube in Dubai Maritime City featuring resort-style amenities, spacious layouts and flexible payment plans for investors and homeowners.',
    ],
];
