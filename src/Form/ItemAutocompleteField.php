<?php

namespace App\Form;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class ItemAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Item::class,
            'placeholder' => 'Choose a Item',
            //'choice_label' => 'name',

            'query_builder' => function(ItemRepository $itemRepository) {
                return $itemRepository->createQueryBuilder('item');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
