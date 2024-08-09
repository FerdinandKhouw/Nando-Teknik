import { Component, OnInit } from '@angular/core';
import { DataService } from '../../service/data.service';
import { Category } from '../../class/category';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.css'] // Perbaiki dari `styleUrl` ke `styleUrls`
})
export class CategoryComponent implements OnInit {

  categories: any;
  category: Category = new Category();
  editingCategory: Category | null = null;

  constructor(private dataService: DataService) { }

  ngOnInit(): void {
    this.getCategoryData();
  }

  getCategoryData(): void {
    this.dataService.getCategoryData().subscribe(res => {
      this.categories = res;
    });
  }

  insertCategoryData(): void {
    if (this.editingCategory) {
      this.updateCategoryData();
    } else {
      this.dataService.insertCategoryData(this.category).subscribe(res => {
        this.getCategoryData();
        this.resetForm();
      });
    }
  }

  selectCategory(category: Category): void {
    this.editingCategory = category;
    this.category = { ...category }; // Menyalin data kategori ke dalam form
  }

  updateCategoryData(): void {
    if (this.editingCategory) {
      this.dataService.updateCategoryData(this.category).subscribe(res => {
        this.getCategoryData();
        this.resetForm();
      });
    }
  }  

  
  deleteCategoryData(id: number): void {
    const confirmation = window.confirm('Are you sure you want to delete this category?');

    if (confirmation) {
        this.dataService.deleteCategoryData(id).subscribe(
            res => {
                // Handle success
                this.getCategoryData();
                window.alert('Category deleted successfully');
            },
            error => {
                // Handle error
                window.alert('Failed to delete category. Please try again.');
            }
        );
    } else {
        window.alert('Category deletion cancelled');
    }
}

  cancelEdit(): void {
    this.resetForm();
  }

  private resetForm(): void {
    this.category = new Category(); // Reset form
    this.editingCategory = null; // Hapus data kategori yang sedang diedit
  }
}