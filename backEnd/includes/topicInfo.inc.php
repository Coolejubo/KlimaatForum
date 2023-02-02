<?php

function topicInfo($topic) {
    if ($topic == 'climateChange') {
        $topicTitle = 'Climate Change';
        $topicInfo = 'Topics related to the global warming, causes and effects of climate change, and potential solutions.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'bioDiversity') {
        $topicTitle = 'Bio diversity';
        $topicInfo = 'Issues related to the loss of species, the preservation of natural habitats, and the impact of human activities on the diversity of life on Earth.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'air') {
        $topicTitle = 'Air Quality';
        $topicInfo = ' Topics related to air pollution, including sources of pollution, health effects, and strategies for improvement.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'water') {
        $topicTitle = 'Water Quality and Availability';
        $topicInfo = 'Issues related to water pollution, scarcity, and conservation.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'soil') {
        $topicTitle = 'Soil Health and Conservation';
        $topicInfo = 'Topics related to soil degradation, erosion, and the importance of healthy soil for food security and environmental sustainability.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'energy') {
        $topicTitle = 'Renewable Energy';
        $topicInfo = 'Discussions about alternative energy sources, such as wind, solar, and hydropower, and their role in reducing reliance on fossil fuels.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'waste') {
        $topicTitle = 'Waste Management';
        $topicInfo = 'Topics related to reducing, reusing, and recycling waste, and minimizing waste generation.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'conservation') {
        $topicTitle = 'Conservation and Protected Areas';
        $topicInfo = 'Discussion about preserving ecosystems, wildlife habitats, and protected areas, and the importance of conserving biodiversity.';
        return [$topicTitle, $topicInfo];
    }
    elseif ($topic == 'policies') {
        $topicTitle = 'Environmental Policy and Law';
        $topicInfo = 'Discussion about environmental regulations, laws, and policies at the local, national, and international levels, and their impact on the environment.';
        return [$topicTitle, $topicInfo];
    }
    return 'not a topic';
}