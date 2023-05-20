<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Chapter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ChapterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chapter::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('number'),
            TextEditorField::new('content'),
            AssociationField::new('book')
        ];
    }

}
