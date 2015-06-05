<?php

namespace proyecto1\SeminarioBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SeminarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SeminarioRepository extends EntityRepository
{

    //Ordenar por fecha no funciona por la datatable!! orden predefinido
    public function findAllOrderedByDate()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e ORDER BY e.fechaCap DESC';
        $consulta = $em->createQuery($dql);
        return $consulta->getResult();
    }
    public function findEventosAnteriores($seminario)
    {
        $fechaHoy= new \DateTime('today');
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.seminario = :seminario AND e.fecha < :fecha ORDER BY e.fechaCap DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('fecha'=>$fechaHoy ,'seminario'=>$seminario));
        return $consulta->getResult();
    }
    public function findEventosSemana()
    {
        $lunes= date('Y/m/d',strtotime('Monday this week'));
        $viernes= date('Y/m/d',strtotime('Friday this week'));
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fechaCap DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }
    public function findEventosSemanaSig()
    {
        $fecha= date("W")+1;
        //$lunes= date('Y/m/d',strtotime(date("Y")."W".$fecha."1"));
        //$viernes= date('Y/m/d',strtotime(date("Y")."W".$fecha."5"));
        $lunes= date('Y/m/d',strtotime('Monday next week'));
        $viernes= date('Y/m/d',strtotime('Friday next week'));
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fechaCap DESC';
        $consulta = $em->createQuery($dql);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }
    public function findEventosToCalendar()
    {
        $fecha= date("W");
        $lunes= date('Y/m/d',strtotime(date("Y")."W".$fecha."1"));

        $fecha2= date("W")+1;
        $viernes= date('Y/m/d',strtotime(date("Y")."W".$fecha2."5"));

        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e WHERE e.fecha BETWEEN :lunes AND :viernes ORDER BY e.fechaCap DESC';
        $consulta = $em->createQuery($dql);
        //$consulta->setParameter('fecha',$fechaHoy);
        //$consulta-> setParameter('seminario',$seminario);
        $consulta->setParameters(array('lunes'=>$lunes,'viernes'=>$viernes));
        return $consulta->getResult();
    }
    public function findEventosToCalendarAll()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT e FROM SeminarioBundle:Evento e';
        $consulta = $em->createQuery($dql);
        return $consulta->getResult();
    }

}


