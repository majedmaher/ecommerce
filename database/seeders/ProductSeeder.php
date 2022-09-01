<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            Product::create([
                'category_id' => 1,
                'product_name_en' => 'Colorful Stylish Shirt',
                'product_name_ar' => 'قميص أنيق ملون',
                'product_slug_en' => strtolower(str_replace(' ', '-', 'Colorful Stylish Shirt')),
                'product_slug_ar' => strtolower(str_replace(' ', '-', 'قميص أنيق ملون')),
                'product_qty' => '15',
                'product_size_en' => 'XS,S,M,L,XL',
                'product_size_ar' => 'XS,S,M,L,XL',
                'product_color_en' => 'Red,Blue,Black',
                'product_color_ar' => 'أحمر,أزرق,أسمر',
                'selling_price' => '300',
                'discount_price' => '230',
                'short_product_description_en' => "Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'short_product_description_ar' => "Volup erat ipsum Diam elitr rebum et dolor. مؤسسة غير معدنية للخرسانة بقطر ثابت كليتا. Sanc invidunt ipsum et، labore clita lorem magna lorem ut. إرات لوريم ثنائي دولور لا بحر نونومي. Accus labore stet، is the lorem sit Diam sea et justo، amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'long_product_description_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.

                Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.",
                'long_product_description_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.

                Dolore magna هي عبارة عن معبد قديم ، يبلغ قطره وقطره وآخرون. Amet dolore tem consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et، amet et labore voluptua sit rebum. Ea erat sed et Diam takimata sed justo. Magna takimata justo et amet magna et.",
                'additional_information_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.",
                'additional_information_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.",
                'additional_information_items_en' => "Sit erat duo lorem duo ea consetetur, et eirmod takimata.",
                'additional_information_items_ar' => "Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.,Amet kasd gubergren sit sanctus et lorem eos sadipscing at.,Duo amet accusam eirmod nonumy stet et et stet eirmod.",
                'trandy' => "0",
                'just_arrived' => "1",
                'spring_collection' => "0",
                'summer_collection' => "1",
                'fall_collection' => "0",
                'winter_collection' => "1",
                'status' => "1",
                'product_thambnail' => 'img/product-' . $i . '.jpg',
            ]);
        }

        for ($i = 3; $i <= 6; $i++) {
            Product::create([
                'category_id' => 4,
                'sub_category_id' => 1,
                'product_name_en' => 'Colorful Stylish Shirt',
                'product_name_ar' => 'قميص أنيق ملون',
                'product_slug_en' => strtolower(str_replace(' ', '-', 'Colorful Stylish Shirt')),
                'product_slug_ar' => strtolower(str_replace(' ', '-', 'قميص أنيق ملون')),
                'product_qty' => '15',
                'product_size_en' => 'XS,S,M,L,XL',
                'product_size_ar' => 'XS,S,M,L,XL',
                'product_color_en' => 'Red,Blue,Black',
                'product_color_ar' => 'أحمر,أزرق,أسمر',
                'selling_price' => '300',
                'discount_price' => '230',
                'short_product_description_en' => "Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'short_product_description_ar' => "Volup erat ipsum Diam elitr rebum et dolor. مؤسسة غير معدنية للخرسانة بقطر ثابت كليتا. Sanc invidunt ipsum et، labore clita lorem magna lorem ut. إرات لوريم ثنائي دولور لا بحر نونومي. Accus labore stet، is the lorem sit Diam sea et justo، amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'long_product_description_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.

                Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.",
                'long_product_description_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.

                Dolore magna هي عبارة عن معبد قديم ، يبلغ قطره وقطره وآخرون. Amet dolore tem consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et، amet et labore voluptua sit rebum. Ea erat sed et Diam takimata sed justo. Magna takimata justo et amet magna et.",
                'additional_information_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.",
                'additional_information_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.",
                'additional_information_items_en' => "Sit erat duo lorem duo ea consetetur, et eirmod takimata.",
                'additional_information_items_ar' => "Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.,Amet kasd gubergren sit sanctus et lorem eos sadipscing at.,Duo amet accusam eirmod nonumy stet et et stet eirmod.",
                'trandy' => "0",
                'just_arrived' => "1",
                'spring_collection' => "0",
                'summer_collection' => "1",
                'fall_collection' => "0",
                'winter_collection' => "1",
                'status' => "1",
                'product_thambnail' => 'img/product-' . $i . '.jpg',
            ]);
        }

        for ($i = 6; $i <= 8; $i++) {
            Product::create([
                'category_id' => 6,
                'sub_category_id' => 4,
                'product_name_en' => 'Colorful Stylish Shirt',
                'product_name_ar' => 'قميص أنيق ملون',
                'product_slug_en' => strtolower(str_replace(' ', '-', 'Colorful Stylish Shirt')),
                'product_slug_ar' => strtolower(str_replace(' ', '-', 'قميص أنيق ملون')),
                'product_qty' => '15',
                'product_size_en' => 'XS,S,M,L,XL',
                'product_size_ar' => 'XS,S,M,L,XL',
                'product_color_en' => 'Red,Blue,Black',
                'product_color_ar' => 'أحمر,أزرق,أسمر',
                'selling_price' => '300',
                'discount_price' => '230',
                'short_product_description_en' => "Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'short_product_description_ar' => "Volup erat ipsum Diam elitr rebum et dolor. مؤسسة غير معدنية للخرسانة بقطر ثابت كليتا. Sanc invidunt ipsum et، labore clita lorem magna lorem ut. إرات لوريم ثنائي دولور لا بحر نونومي. Accus labore stet، is the lorem sit Diam sea et justo، amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'long_product_description_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.

                Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.",
                'long_product_description_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.

                Dolore magna هي عبارة عن معبد قديم ، يبلغ قطره وقطره وآخرون. Amet dolore tem consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et، amet et labore voluptua sit rebum. Ea erat sed et Diam takimata sed justo. Magna takimata justo et amet magna et.",
                'additional_information_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.",
                'additional_information_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.",
                'additional_information_items_en' => "Sit erat duo lorem duo ea consetetur, et eirmod takimata.",
                'additional_information_items_ar' => "Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.,Amet kasd gubergren sit sanctus et lorem eos sadipscing at.,Duo amet accusam eirmod nonumy stet et et stet eirmod.",
                'trandy' => "1",
                'just_arrived' => "0",
                'spring_collection' => "0",
                'summer_collection' => "0",
                'fall_collection' => "1",
                'winter_collection' => "1",
                'status' => "1",
                'product_thambnail' => 'img/product-' . $i . '.jpg',
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Product::create([
                'category_id' => 6,
                'sub_category_id' => 3,
                'product_name_en' => 'Colorful Stylish Shirt',
                'product_name_ar' => 'قميص أنيق ملون',
                'product_slug_en' => strtolower(str_replace(' ', '-', 'Colorful Stylish Shirt')),
                'product_slug_ar' => strtolower(str_replace(' ', '-', 'قميص أنيق ملون')),
                'product_qty' => '15',
                'product_size_en' => 'XS,S,M,L,XL',
                'product_size_ar' => 'XS,S,M,L,XL',
                'product_color_en' => 'Red,Blue,Black',
                'product_color_ar' => 'أحمر,أزرق,أسمر',
                'selling_price' => '300',
                'discount_price' => '230',
                'short_product_description_en' => "Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'short_product_description_ar' => "Volup erat ipsum Diam elitr rebum et dolor. مؤسسة غير معدنية للخرسانة بقطر ثابت كليتا. Sanc invidunt ipsum et، labore clita lorem magna lorem ut. إرات لوريم ثنائي دولور لا بحر نونومي. Accus labore stet، is the lorem sit Diam sea et justo، amet at lorem et eirmod ipsum diam et rebum kasd rebum.",
                'long_product_description_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.

                Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.",
                'long_product_description_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.

                Dolore magna هي عبارة عن معبد قديم ، يبلغ قطره وقطره وآخرون. Amet dolore tem consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et، amet et labore voluptua sit rebum. Ea erat sed et Diam takimata sed justo. Magna takimata justo et amet magna et.",
                'additional_information_en' => "Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.",
                'additional_information_ar' => "Eos no lorem eirmod Diam، eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum، dolor rebum eirmod consetetur invidunt sed et، lorem duo et eos elitr، sadipscing kasd ipsum rebum diam. Dolore Diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum الاتهام ساديبسسينغ ، يوس دولوريس الجلوس لا يو تي ديام كونسيتيتور ديو جوستو إيست ، سيت سانكتوس ديام تايم أليكويام إيرمود نونومي ريبوم كولور أكوسام ، إيبسوم كاسد إيوس كونسيتيتور في سيت ريبوم ، ديام كاسد إنفيدونت سانيتورم ، إيبسكتوس لوريم غير شرعي.",
                'additional_information_items_en' => "Sit erat duo lorem duo ea consetetur, et eirmod takimata.",
                'additional_information_items_ar' => "Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.,Amet kasd gubergren sit sanctus et lorem eos sadipscing at.,Duo amet accusam eirmod nonumy stet et et stet eirmod.",
                'trandy' => "1",
                'just_arrived' => "1",
                'spring_collection' => "1",
                'summer_collection' => "1",
                'fall_collection' => "1",
                'winter_collection' => "1",
                'status' => "1",
                'product_thambnail' => 'img/product-' . $i . '.jpg',
            ]);
        }
    }
}
