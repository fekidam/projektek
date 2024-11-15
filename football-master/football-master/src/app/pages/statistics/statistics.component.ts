import { Component } from '@angular/core';
import { Player } from './models/player.model';

@Component({
  selector: 'app-statistics',
  templateUrl: './statistics.component.html',
  styleUrls: ['./statistics.component.scss']
})
export class StatisticsComponent {
  public players: Player[] = [
    {
      name: 'Karim Benzema',
      achievementNum: 17,
      achievementName: 'Gólok',
      img: 'https://i.pinimg.com/originals/28/d4/50/28d4501388a1a14056be5e5db40384ee.png',
      color: '#E3D835',
    },
    {
      name: 'Mikel Merino',
      achievementNum: 9,
      achievementName: 'Asszisztok',
      img: 'https://sportsmanheight.com/wp-content/uploads/2022/04/6-11.png',
      color: '#15C4D1',
    },
    {
      name: 'Daniel Parejo',
      achievementNum: 1918,
      achievementName: 'Sikeres passzok',
      img: 'https://assets.laliga.com/squad/2022/t449/p51952/2048x2225/p51952_t449_2022_1_001_000.png',
      color: '#D399f5',
    },
    {
      name: 'Edgar Badia',
      achievementNum: 120,
      achievementName: 'Védések',
      img: 'https://assets.laliga.com/squad/2022/t954/p110923/2048x2225/p110923_t954_2022_1_001_000.png',
      color: '#F6933C',
    },
    {
      name: 'Óscar Gil',
      achievementNum: 12,
      achievementName: 'Sárga lapok',
      img: 'https://assets.laliga.com/squad/2022/t177/p468115/2048x2225/p468115_t177_2022_1_001_000.png',
      color: '#ffd900',
    },
    {
      name: 'Florian Lejeune',
      achievementNum: 3,
      achievementName: 'Piros lapok',
      img: 'https://assets.laliga.com/squad/2022/t184/p77359/2048x2225/p77359_t184_2022_1_001_000.png',
      color: '#BC0610',
    }
  ]
}
