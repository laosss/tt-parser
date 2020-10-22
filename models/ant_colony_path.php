<?php

class ant_colony_path {

    private $ALPHA;  // регулир параметр значимости
    private $BETA;  // регулир параметр видимости
    private Ant $ant_list;  // список всех муравьев
    private $best_tour_length;
    private $best_tour_list;  // лучший найденый маршрут 
    public City $city_list;
    public $distances;  // матрица расстояний
    public $distances_empty;  // флаг(bool) = матрица не существует либо задана нулевыми элементами
    private $iterations;  // число итераций алгор(регулир параметр)
    private $num_ants;  // число муравьёв (регулир параметр)
    private $num_cities;   // число вершин (регулир параметр)
    private $pherom_const;  // феромонный коэффициент (регулир параметр)
    public $pheromones;  // матрица феромонов
    public $pheromones_empty;  // bool
    private $rand;
    private $random_cities;  // Флаг, обозначающий автоматический режим расстановки вершин 
    private $RHO;  // регулир коэффициент испарения феромона 

    private function antsStop() {  // bool

        $moved = 0;
        for( $i = 0; $i < $this->num_ants; $i++ )
        {
            if( count( $this->ant_list[$i]->tour_list ) < $this->num_cities )
            {//муравьи ещё двигаются
                goToNextCity($this->ant_list[$i]);
                $moved++;
            }
        }
        if( $moved == 0 )
        {
            return true;  // муравьи не двигаются
        }
        else 
            return false;

    }

    private function bestTour() {

        $best_local_tour = $this->ant_list[0]->get_distance();
        $save_index = 0;
        $cnt = count( $this->ant_list );
        for( $i = 1; $i < $cnt; $i++ )  // проверяет длину лучшего обхода на этой итерации
        {
            if( $this->ant_list[$i]->get_distance() < $best_local_tour )
            {
                $best_local_tour = $this->ant_list[$i]->get_distance();
                $save_index = $i;
            }
        }

        //сравниваем лучший локальный путь с лучшим глобальным и обновляем
        if( $best_local_tour < $this->best_tour_length || $this->best_tour_length == -1 )
        {
            $this->best_tour_list = $this->ant_list[$save_index]->tour_list;
            $this->best_tour_length = $best_local_tour;
        }

    }

    private function calculate() { 
        $this->ALPHA = 1.0;
        $this->BETA = 1.0;
        $this->RHO = 0.5; 
        $this->iterations = 100;
        $this->pherom_const = 100;

        for( $k = 0; $k < $this->iterations; $k++ ) {

            for( $i = 0; $i < $this->num_cities; $i++ )//муравьи идут до конца
            if( $this->antsStop() ) {  // двигает муравьёв на шаг вперёд и проверяет, дошли ли они до конца            
                evaporatePheromones();  // !!!
                updatePheromones();  // !!!
                $this->bestTour();  // проверяет муравьёв на наличие оптимальных маршрутов
                initAnts();  //сбрасывает позиции муравьёв  !!!
            }

            //city_list[best_tour_list[0]].DrawFinish(g);
            //g.DrawString(string.Format("Итерация {0}", k + 1), new Font("Arial", 10), new
            //SolidBrush(Color.Black), 10, 10);
            
            // $cnt = count( $this->best_tour_list );
            // for ( $i = 0; $i < $cnt; $i++)
            // {
            //     Pen p = new Pen(Color.Orange, 1);
            //     p.EndCap = System.Drawing.Drawing2D.LineCap.ArrowAnchor;
            //     p.StartCap = System.Drawing.Drawing2D.LineCap.Square;
            //     g.DrawLine(p, city_list[best_tour_list[i]].getLocation(), city_list[best_tour_list[(i + 1) % num_cities]].getLocation());
            // }

            // myCanvas.Save(s, System.Drawing.Imaging.ImageFormat.Bmp);
            // algorithm_steps.Add(Image.FromStream(s));
            // sw.WriteLine(best_tour_length);
            // acoWatch.Start();
            
            // g = null;
            // s.Close();
            // sw.Close();
        } 

    }

    function evaporatePheromones() {  // Испаряет все феромоны 
        for ( $i = 0; $i < $this->num_cities; $i++)
            for ( $k = 0; $k < $this->num_cities; $k++)
            {
                $this->pheromones[$i][$k] *= ( 1.0 - $this->RHO );
                //значение феромонов не должно падать ниже изначального
                if ( $this->pheromones[$i][$k] < 1.0 / (double)$this->num_cities )
                {
                    $this->pheromones[$i][$k] = Math.Round(1.0 / (double)$this->num_cities, 2);
                }
            } 
    }

    function fact( $n ) {}

    function goToNextCity( Ant $curr_ant ) {} 

    function initAnts() {}

    function initCities( $g ) {}  // ?

    function initPherom() {}

    function initializeAntColony( $g ) {}

    function permute( $total, $v_arr, $start, $n ) {}

    function updatePheromones() {  // Обновляет феромон 

    }

}