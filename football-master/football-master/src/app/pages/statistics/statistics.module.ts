import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { StatisticsComponent } from './statistics.component';
import { PlayerCardComponent } from './player-card/player-card.component';


@NgModule({
  declarations: [StatisticsComponent, PlayerCardComponent],
  imports: [
    CommonModule,
  ],
  exports: [StatisticsComponent]
})
export class StatisticsModule { }
