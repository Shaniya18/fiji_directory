<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Government',
                'description' => 'Government ministries, departments, and public services',
                'subcategories' => [
                    'National Government',
                    'Local Government Authorities',
                    'Ministries & Departments',
                    'Public Services',
                    'Regulatory Bodies'
                ]
            ],
            [
                'name' => 'Education',
                'description' => 'Schools, universities, and training institutions',
                'subcategories' => [
                    'Primary Schools',
                    'Secondary Schools',
                    'Higher Education',
                    'Training Institutes',
                    'Education NGOs'
                ]
            ],
            [
                'name' => 'Health',
                'description' => 'Hospitals, clinics, and health organizations',
                'subcategories' => [
                    'Hospitals',
                    'Clinics',
                    'Public Health Services',
                    'Mental Health Services'
                ]
            ],
            [
                'name' => 'Business',
                'description' => 'Commercial enterprises and services',
                'subcategories' => [
                    'Retail & Wholesale',
                    'Manufacturing',
                    'Small and Medium Enterprises',
                    'Corporate Services',
                    'Financial Services'
                ]
            ],
            [
                'name' => 'Environment & NGOs',
                'description' => 'Environmental and non-profit organizations',
                'subcategories' => [
                    'Environmental Protection Organizations',
                    'Climate Change Initiatives',
                    'Sustainable Agriculture',
                    'Renewable Energy Projects'
                ]
            ],
            [
                'name' => 'Tourism',
                'description' => 'Travel, hospitality, and tourist services',
                'subcategories' => [
                    'Travel Agencies',
                    'Tour Operators',
                    'Hotels & Accommodations',
                    'Tourist Attractions',
                    'Cultural Tourism'
                ]
            ],
            [
                'name' => 'Media',
                'description' => 'News, broadcasting, and media outlets',
                'subcategories' => [
                    'Television Stations',
                    'Radio Stations',
                    'Newspapers & Magazines',
                    'Online News Portals',
                    'Social Media Platforms'
                ]
            ],
            [
                'name' => 'Law & Justice',
                'description' => 'Legal and justice system services',
                'subcategories' => [
                    'Courts & Tribunals',
                    'Police & Law Enforcement',
                    'Legal Aid Services',
                    'Correctional Facilities',
                    'Human Rights Organizations'
                ]
            ],
            [
                'name' => 'Services',
                'description' => 'Public and private service providers',
                'subcategories' => [
                    'Public Utilities',
                    'Postal & Courier Services',
                    'Transportation & Logistics',
                    'IT & Communication Services',
                    'Cleaning & Maintenance'
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'parent_category_id' => null,
            ]);

            foreach ($categoryData['subcategories'] as $subname) {
                Category::create([
                    'name' => $subname,
                    'description' => 'Subcategory of ' . $categoryData['name'],
                    'parent_category_id' => $category->id,
                ]);
            }
        }
    }
}