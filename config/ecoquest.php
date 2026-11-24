<?php

/*
|--------------------------------------------------------------------------
| EcoQuest content
|--------------------------------------------------------------------------
| All quiz, test and survey content lives here so the group can edit it
| without touching the code. 'answer' is the index (0-3) of the correct option.
| To show your own video in a level, paste a YouTube *embed* link into
| 'video' (e.g. https://www.youtube.com/embed/VIDEO_ID).
*/

return [

    // Admin login, read from .env (ADMIN_EMAIL / ADMIN_PASSWORD) so it never goes to GitHub.
    'admin' => [
        'email' => env('ADMIN_EMAIL', 'admin@ecoquest.test'),
        'password' => env('ADMIN_PASSWORD'),
    ],

    'points' => [
        'pre_test' => 10,
        'activity' => 20,
        'quiz_per_correct' => 10,
        'post_test' => 10,
        'survey' => 10,
    ],

    // Correct answers needed (out of 5) to pass a level quiz.
    'quiz_pass_mark' => 3,

    'levels' => [

        1 => [
            'title' => 'Climate Change 101',
            'tagline' => 'What is climate change, and why does it matter to Malaysia?',
            'video' => null,
            'video_caption' => 'Intro video: the December 2021 floods and what is changing in our climate',
            'hook' => 'Do you remember the floods of December 2021? Was that just bad luck, or part of a bigger pattern?',
            'recall' => 'Before we start: what do you think a "greenhouse gas" is? Keep your answer in mind, you will check it in a few minutes.',
            'objectives' => [
                'Explain the difference between weather and climate',
                'Describe how the greenhouse effect warms the Earth',
                'Identify human activities that cause climate change and its effects on Malaysia',
            ],
            'activity_name' => 'Cause & Effect Chain',
            'badge' => 'Climate Explorer',
            'quiz' => [
                [
                    'q' => 'What is the difference between weather and climate?',
                    'options' => [
                        'They mean exactly the same thing',
                        'Weather is today\'s conditions; climate is the average pattern over many years',
                        'Climate is today\'s conditions; weather is the long-term pattern',
                        'Weather only refers to rain',
                    ],
                    'answer' => 1,
                    'explain' => 'Weather changes day to day. Climate is the average weather pattern of a place over a long period, usually 30 years or more.',
                ],
                [
                    'q' => 'Which human activity releases the most carbon dioxide (CO₂)?',
                    'options' => [
                        'Planting trees',
                        'Recycling paper',
                        'Burning fossil fuels such as coal, oil and gas',
                        'Cycling to class',
                    ],
                    'answer' => 2,
                    'explain' => 'Burning coal, oil and natural gas for electricity, transport and industry is the largest human source of CO₂.',
                ],
                [
                    'q' => 'Why does cutting down forests make climate change worse?',
                    'options' => [
                        'Fewer trees are left to absorb CO₂ from the air',
                        'Trees produce greenhouse gases',
                        'Forests make the weather colder',
                        'It does not affect the climate',
                    ],
                    'answer' => 0,
                    'explain' => 'Trees absorb CO₂ as they grow. Clearing and burning forests removes that "carbon sink" and releases stored carbon.',
                ],
                [
                    'q' => 'What do greenhouse gases do in the atmosphere?',
                    'options' => [
                        'Block all sunlight from reaching Earth',
                        'Trap heat and keep the Earth warm',
                        'Create oxygen for us to breathe',
                        'Cause earthquakes',
                    ],
                    'answer' => 1,
                    'explain' => 'Greenhouse gases let sunlight in but trap some of the heat trying to escape. More of these gases means more trapped heat.',
                ],
                [
                    'q' => 'Which Malaysian ministry launched the National Climate Change Policy 2.0?',
                    'options' => [
                        'Ministry of Education',
                        'Ministry of Natural Resources and Environmental Sustainability (NRES)',
                        'Ministry of Health',
                        'Ministry of Transport',
                    ],
                    'answer' => 1,
                    'explain' => 'NRES launched the National Climate Change Policy 2.0, which aims for net-zero greenhouse gas emissions by 2050 (Bernama, 2024).',
                ],
            ],
        ],

        2 => [
            'title' => 'Your Carbon Footprint',
            'tagline' => 'How do your everyday choices add to climate change?',
            'video' => null,
            'video_caption' => 'Intro video: a day in the life of a student, and the carbon behind it',
            'hook' => 'From your morning Grab ride to the air-conditioner at night, every day leaves a trail of carbon. How big is yours?',
            'recall' => 'Think back to Level 1: which human activity releases the most CO₂? Hold that thought, it is the key to your footprint.',
            'objectives' => [
                'Define what a carbon footprint is',
                'Analyse which daily habits create the most emissions',
                'Use the Air Pollutant Index (API) to make safer daily decisions',
            ],
            'activity_name' => 'Carbon Footprint Calculator',
            'badge' => 'Carbon Cutter',
            'quiz' => [
                [
                    'q' => 'What is a carbon footprint?',
                    'options' => [
                        'The mark your shoe leaves on the ground',
                        'The total greenhouse gases caused by a person\'s activities',
                        'The amount of oxygen a person breathes',
                        'A type of recycling bin',
                    ],
                    'answer' => 1,
                    'explain' => 'Your carbon footprint is the total amount of greenhouse gases released because of the things you do, use and buy.',
                ],
                [
                    'q' => 'Your class is 2 km away. Which is the lowest-carbon way to get there?',
                    'options' => [
                        'Drive alone',
                        'Book an e-hailing car alone',
                        'Walk or cycle',
                        'Ride alone on a motorcycle',
                    ],
                    'answer' => 2,
                    'explain' => 'Walking and cycling burn no fuel at all. For longer trips, public transport and carpooling share the emissions among many people.',
                ],
                [
                    'q' => 'Which app from Jabatan Alam Sekitar (JAS) shows the Air Pollutant Index (API)?',
                    'options' => ['MySejahtera', 'MyJAS EQMS', 'Touch \'n Go eWallet', 'Waze'],
                    'answer' => 1,
                    'explain' => 'The MyJAS EQMS app (APIMS dashboard) shows hourly API readings from DOE monitoring stations (Fam, 2025).',
                ],
                [
                    'q' => 'Which is the best way to save electricity with an air-conditioner?',
                    'options' => [
                        'Set it to 16°C so the room cools faster',
                        'Set it to around 25°C and switch it off when you leave',
                        'Leave it on all day so the room stays cool',
                        'Open the windows while it is running',
                    ],
                    'answer' => 1,
                    'explain' => 'A slightly higher temperature uses less energy, and switching it off when nobody is in the room avoids wasted electricity.',
                ],
                [
                    'q' => 'Why does wasting food add to climate change?',
                    'options' => [
                        'It does not affect the climate',
                        'Food is made from plastic',
                        'The energy used to grow, transport and cook it is wasted, and rotting food in landfills releases methane',
                        'Food waste cools the Earth',
                    ],
                    'answer' => 2,
                    'explain' => 'Every meal carries the emissions of farming, transport and cooking. Food rotting in landfills also releases methane, a strong greenhouse gas.',
                ],
            ],
        ],

        3 => [
            'title' => 'Waste & Recycling',
            'tagline' => 'Where does your rubbish go, and how can you send less of it there?',
            'video' => null,
            'video_caption' => 'Intro video: following one plastic bottle from a mamak table to the landfill',
            'hook' => 'Nearly 40% of the rubbish sent to Malaysian landfills could have been recycled. What happens to the bottle you threw away today?',
            'recall' => 'In Level 2 you learned that rotting food in landfills releases a greenhouse gas. Which gas was it?',
            'objectives' => [
                'Explain the waste hierarchy: Reduce, Reuse, Recycle',
                'Sort common household waste into the correct category',
                'Describe Malaysia\'s waste situation and the role of SWCorp',
            ],
            'activity_name' => 'Sort the Trash',
            'badge' => 'Recycling Rookie',
            'quiz' => [
                [
                    'q' => 'Which step of the waste hierarchy is the BEST for the environment?',
                    'options' => ['Recycle', 'Reduce', 'Throw it in the landfill', 'Burn it'],
                    'answer' => 1,
                    'explain' => 'Reducing waste is best, because waste that is never created needs no energy to collect, process or recycle.',
                ],
                [
                    'q' => 'What was Malaysia\'s national recycling rate in 2024?',
                    'options' => ['10%', '25.5%', '37.9%', '75%'],
                    'answer' => 2,
                    'explain' => 'The national recycling rate was 37.9% in 2024, up from 35.38% in 2023 (Dzulkifli, 2026).',
                ],
                [
                    'q' => 'What is the best thing to do with a banana peel?',
                    'options' => ['Put it in the plastic recycling bin', 'Compost it', 'Burn it', 'Throw it in a drain'],
                    'answer' => 1,
                    'explain' => 'Food waste such as fruit peels can be composted into fertiliser instead of rotting in a landfill.',
                ],
                [
                    'q' => 'Which agency manages solid waste and public cleansing in Peninsular Malaysia?',
                    'options' => ['MetMalaysia', 'SWCorp', 'NADMA', 'Jabatan Pertanian'],
                    'answer' => 1,
                    'explain' => 'SWCorp (Perbadanan Pengurusan Sisa Pepejal dan Pembersihan Awam) manages solid waste and runs recycling awareness programmes.',
                ],
                [
                    'q' => 'What should you do before putting a plastic bottle in the recycling bin?',
                    'options' => [
                        'Fill it with leftover food',
                        'Empty and rinse it',
                        'Wrap it in a plastic bag',
                        'Nothing, dirty bottles recycle best',
                    ],
                    'answer' => 1,
                    'explain' => 'Food and drink left inside can contaminate a whole batch of recyclables, so empty and rinse containers first.',
                ],
            ],
        ],

        4 => [
            'title' => 'Green Student Life',
            'tagline' => 'Small daily choices that add up to a greener Malaysia.',
            'video' => null,
            'video_caption' => 'Intro video: one week of greener habits on campus',
            'hook' => 'Imagine Malaysia in 2050. Will your city be cooler, greener and safer, or hotter and flooded? The choices you make now help decide.',
            'recall' => 'Quick recall: name one habit from Level 2 and one from Level 3 that lowers your impact.',
            'objectives' => [
                'Apply sustainable habits in energy, transport, food and fashion',
                'Explain how urban farming and local food reduce emissions',
                'Identify where to find flood and disaster information in Malaysia',
            ],
            'activity_name' => 'Malaysia 2050 Scenario',
            'badge' => 'Green Student',
            'quiz' => [
                [
                    'q' => 'You need new clothes for Hari Raya. Which is the most sustainable choice?',
                    'options' => [
                        'Buy five new outfits online to choose from',
                        'Rewear, borrow, buy pre-loved or buy only what you really need',
                        'Buy cheap clothes and throw them away after one use',
                        'Buy a new outfit for every day of Raya',
                    ],
                    'answer' => 1,
                    'explain' => 'Making clothes uses a lot of energy, water and materials. Buying less and choosing pre-loved items lowers that impact.',
                ],
                [
                    'q' => 'How does urban farming (pertanian bandar) help the environment?',
                    'options' => [
                        'Food grown near where it is eaten needs less transport and packaging',
                        'It makes vegetables more expensive',
                        'It uses more plastic',
                        'It has no benefit',
                    ],
                    'answer' => 0,
                    'explain' => 'Growing food close to home cuts transport, packaging and food waste, and community gardens can turn food scraps into compost.',
                ],
                [
                    'q' => 'Where can you check river levels and flood information in Malaysia?',
                    'options' => ['Public InfoBanjir by JPS', 'A shopping app', 'A food delivery app', 'A music streaming app'],
                    'answer' => 0,
                    'explain' => 'Public InfoBanjir by the Department of Irrigation and Drainage (JPS) shows rainfall and river level information.',
                ],
                [
                    'q' => 'Why is carpooling better for the climate than driving alone?',
                    'options' => [
                        'Cars run faster with more people',
                        'Fewer cars on the road means less fuel burned overall',
                        'It is not better',
                        'It makes the car electric',
                    ],
                    'answer' => 1,
                    'explain' => 'Sharing one car among several people replaces several separate trips, so less fuel is burned and less CO₂ is released.',
                ],
                [
                    'q' => 'What is the benefit of bringing your own container when you tapau food?',
                    'options' => [
                        'It reduces single-use plastic and polystyrene waste',
                        'It makes the food more expensive',
                        'It has no benefit',
                        'It increases waste',
                    ],
                    'answer' => 0,
                    'explain' => 'Reusable containers replace single-use packaging that usually ends up in landfills.',
                ],
            ],
        ],
    ],

    // Pre-test and post-test use the SAME 10 questions, so the score difference shows learning gain.
    'test' => [
        [
            'q' => 'Which gas is mainly released when fossil fuels are burned?',
            'options' => ['Oxygen', 'Carbon dioxide (CO₂)', 'Nitrogen', 'Helium'],
            'answer' => 1,
        ],
        [
            'q' => 'What is the greenhouse effect?',
            'options' => [
                'Gases in the atmosphere trapping heat and keeping the Earth warm',
                'A hole in the ozone layer',
                'Plants growing inside glass houses',
                'The oceans becoming colder',
            ],
            'answer' => 0,
        ],
        [
            'q' => 'By which year does Malaysia aim to reach net-zero greenhouse gas emissions?',
            'options' => ['2030', '2040', '2050', '2070'],
            'answer' => 2,
        ],
        [
            'q' => 'Which Malaysian agency publishes the Air Pollutant Index (API / IPU)?',
            'options' => ['Jabatan Alam Sekitar (JAS)', 'SWCorp', 'Jabatan Pertanian', 'NADMA'],
            'answer' => 0,
        ],
        [
            'q' => 'An API reading of 101 or above means the air is:',
            'options' => ['Good', 'Moderate', 'Unhealthy', 'Perfectly clean'],
            'answer' => 2,
        ],
        [
            'q' => 'Which way of travelling 3 km to class produces the least carbon emissions?',
            'options' => ['Driving alone', 'Walking or cycling', 'E-hailing alone', 'Riding a motorcycle alone'],
            'answer' => 1,
        ],
        [
            'q' => 'Which item should NOT go into a recycling bin?',
            'options' => ['A clean newspaper', 'An empty aluminium can', 'Leftover food', 'A rinsed glass bottle'],
            'answer' => 2,
        ],
        [
            'q' => 'In the 3R waste hierarchy, what does "Reduce" mean?',
            'options' => [
                'Using less and avoiding waste in the first place',
                'Cutting rubbish into smaller pieces',
                'Burning waste',
                'Sending waste to another country',
            ],
            'answer' => 0,
        ],
        [
            'q' => 'Why does fast fashion contribute to climate change?',
            'options' => [
                'Clothes absorb CO₂',
                'Producing and shipping large amounts of cheap clothing uses a lot of energy and resources',
                'Cotton cools the planet',
                'It does not contribute',
            ],
            'answer' => 1,
        ],
        [
            'q' => 'Which is a good way to save electricity in your hostel room?',
            'options' => [
                'Set the air-conditioner to 16°C',
                'Leave the lights on when you go out',
                'Set the air-conditioner to around 25°C and switch off appliances when you leave',
                'Keep chargers plugged in all day',
            ],
            'answer' => 2,
        ],
    ],

    'survey' => [
        'q1' => 'The EcoQuest website is easy to navigate and use.',
        'q2' => 'The design and layout of the website are attractive.',
        'q3' => 'The multimedia elements (video, graphics, animation) helped me understand the content.',
        'q4' => 'The activities and games were interesting and engaging.',
        'q5' => 'After using EcoQuest, I am more motivated to practise sustainable living.',
    ],

];
