import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { ResultsComponent } from './pages/results/results.component';
import { StatisticsComponent } from './pages/statistics/statistics.component';
import { OverviewComponent } from './pages/overview/overview.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent,
  loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule)},
  { path: 'results', component: ResultsComponent,
  loadChildren: () => import('./pages/results/results.module').then(m => m.ResultsModule)},
  { path: 'statistics',component: StatisticsComponent,
   loadChildren: () => import('./pages/statistics/statistics.module').then(m => m.StatisticsModule)},
  { path: 'overview',component: OverviewComponent,
   loadChildren: () => import('./pages/overview/overview.module').then(m => m.OverviewModule)},
  { path:'',  pathMatch: 'full', redirectTo: 'home'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
