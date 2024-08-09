import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class DataService {

  constructor(private httpClient:HttpClient) {}

  //Get data
  getCategoryData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/categories');
  }
  getProductData() { 
    return this.httpClient.get('http://127.0.0.1:8000/api/products');
  }
  getSupplierData() { 
    return this.httpClient.get('http://127.0.0.1:8000/api/suppliers');
  }
  getCustomerData() { 
    return this.httpClient.get('http://127.0.0.1:8000/api/customers');
  }
  getPurchaseData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/purchases');
  }
  getSalesData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/sales');
  }
  getServiceProductData() {
    return this.httpClient.get('http://127.0.0.1:8000/api/service-products');
  }

  //Post data
  insertCategoryData(data:any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addCategory', data);
  }
  insertProductData(data:any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addProduct', data);
  }
  insertSupplierData(data:any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addSupplier', data);
  }
  insertCustomerData(data:any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addCustomer', data);
  }
  insertPurchaseData(data: any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addPurchase', data);
  }
  insertSalesData(data: any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addSale', data);
  }
  getReportData(params: any){
    return this.httpClient.post('http://127.0.0.1:8000/api/getReport', params);
  }
  insertServiceProductData(data:any) {
    return this.httpClient.post('http://127.0.0.1:8000/api/addServiceProduct', data);
  }


  //Update Data
  updateCategoryData(data:any) {
    return this.httpClient.put('http://127.0.0.1:8000/api/updateCategory', data);
  }

  //Delete data
  deleteCategoryData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteCategory/'+id);
  }
  deleteProductData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteProduct/'+id);
  }
  deleteSupplierData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteSupplier/'+id);
  }
  deleteCustomerData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteCustomer/'+id);
  }
  deletePurchaseData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deletePurchase/'+id);
  }
  deleteSalesData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteSale/'+id);
  }
  deleteServiceProductData(id: any) {
    return this.httpClient.delete('http://127.0.0.1:8000/api/deleteServiceProduct/'+id);
  }
}
