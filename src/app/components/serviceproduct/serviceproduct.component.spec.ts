import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ServiceproductComponent } from './serviceproduct.component';

describe('ServiceproductComponent', () => {
  let component: ServiceproductComponent;
  let fixture: ComponentFixture<ServiceproductComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ServiceproductComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ServiceproductComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
